<?php


namespace App\CustomClass;


use App\EmergencyContact;

class EmergencyData
{

    private $id;
    private $emergency_data;

    function __construct($emergency_id)
    {
        $emergency = EmergencyContact::findOrFail($emergency_id);
        $this->id = $emergency->id;
        $this->setEmergencyData($emergency);
    }

    /**
     * @return mixed
     */
    public function getEmergencyData()
    {
        return $this->emergency_data;
    }

    /**
     * @param mixed $blog_data
     */
    private function setEmergencyData($emergency_data)
    {
        $this->emergency_data = $emergency_data;
    }


    public static function create_emergency($emergency)
    {
        EmergencyContact::create($emergency);
        return response()->json(['message' => true]);
    }

    public static function update_emergency($id,$data)
    {
        EmergencyContact::findOrFail($id)->update($data);
        return response()->json(['message' => true]);
    }

    public static function delete_emergency($id)
    {
        EmergencyContact::findOrFail($id)->delete();
        return response()->json(['message' => true]); 
    }

}