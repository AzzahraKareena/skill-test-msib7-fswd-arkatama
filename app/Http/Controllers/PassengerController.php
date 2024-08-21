<?php


namespace App\Http\Controllers;

use App\Models\Passenger;
use App\Models\Travel;
use Illuminate\Http\Request;

class PassengerController extends Controller
{

    public function index()
    {
        $passengers = Passenger::all();
        return view('passengers.index', compact('passengers'));
    }

    public function create()
    {
        $travels = Travel::whereDate('id_tanggal_keberangkatan', '>', now())
                         ->where('kuota', '>', 0)
                         ->get();
                         
        return view('passengers.create', compact('travels'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_travel' => 'required|exists:travel,id',
            'passenger_data' => 'required|string'
        ]);

        $travel = Travel::findOrFail($request->id_travel);
        $passengerData = $this->parsePassengerData($request->passenger_data);


        $existingPassenger = Passenger::where('id_travel', $travel->id)
            ->where('nama', strtoupper($passengerData['nama']))
            ->exists();

        if ($existingPassenger) {
            return redirect()->back()->withErrors(['passenger_data' => 'Passenger already booked for this travel.']);
        }


        $orderNumber = Passenger::where('id_travel', $travel->id)->count() + 1;
        $bookingCode = Passenger::generateBookingCode($travel->id, $orderNumber);

        Passenger::create(array_merge($passengerData, [
            'id_travel' => $travel->id,
            'kode_booking' => $bookingCode,
            'created_at' => now(), 
        ]));

        $travel->decrement('kuota');

        return redirect()->route('passengers.index')->with('success', 'Passenger booked successfully.');
    }

 
    public function edit(Passenger $passenger)
    {
        $travels = Travel::whereDate('id_tanggal_keberangkatan', '>', now())
                         ->where('kuota', '>', 0)
                         ->get();
                         
        return view('passengers.edit', compact('passenger', 'travels'));
    }

 
    public function update(Request $request, Passenger $passenger)
    {
        $request->validate([
            'id_travel' => 'required|exists:travel,id',
            'passenger_data' => 'required|string'
        ]);

        $travel = Travel::findOrFail($request->id_travel);
        $passengerData = $this->parsePassengerData($request->passenger_data);

        $existingPassenger = Passenger::where('id_travel', $travel->id)
            ->where('nama', strtoupper($passengerData['nama']))
            ->where('id', '<>', $passenger->id)
            ->exists();

        if ($existingPassenger) {
            return redirect()->back()->withErrors(['passenger_data' => 'Passenger already booked for this travel.']);
        }

        $passenger->update(array_merge($passengerData, [
            'id_travel' => $travel->id,
            'created_at' => now(), // Set created_at jika diperlukan
        ]));

        return redirect()->route('passengers.index')->with('success', 'Passenger updated successfully.');
    }

 
    public function destroy(Passenger $passenger)
    {
        $passenger->delete();

        return redirect()->route('passengers.index')->with('success', 'Passenger deleted successfully.');
    }


    private function parsePassengerData($data)
    {
        $data = strtoupper(trim($data));
        preg_match('/^(.*?)\s(\d+)\s(.*?)$/', $data, $matches);

        if (!$matches) {
            abort(400, 'Invalid passenger data format.');
        }

        $name = $matches[1];
        $age = $matches[2];
        $city = $matches[3];
        $yearOfBirth = date('Y') - $age;

        $age = preg_replace('/\s*TAHUN\s*$/i', '', $age);
        $age = preg_replace('/\s*THN\s*$/i', '', $age);
        $age = preg_replace('/\s*TH\s*$/i', '', $age);

        return [
            'nama' => $name,
            'usia' => (int)$age,
            'kota' => $city,
            'tahun_lahir' => $yearOfBirth,
        ];
    }
}
