<?php

namespace App\CustomClass;

use App\Education;

class EducationData
{

    private $edu_data;

    public function __construct($edu_id)
    {
        $edus = Education::findOrFail($edu_id);
        $this->setNewData($edus);
    }

    /**
     * @return mixed
     */
    public function getNewData()
    {
        $photo_url = DAN::$domain_url . 'upload/education/' . $this->edu_data['photo'];
        $this->edu_data['photo'] = $photo_url;
        return $this->edu_data;
    }

    /**
     * @param mixed $blog_data
     */
    private function setNewData($edu_data)
    {

        $this->edu_data = $edu_data;
    }

    public static function format($arr)
    {
        $data = [];
        foreach ($arr as $edus) {
            $obj = new EducationData($edus['id']);
            array_push($data, $obj->getNewData());
        }
        return $data;
    }

    public static function create_education($education)
    {

        $photo = $education['photo'];
        $photoname = uniqid() . '_' . $photo->getClientOriginalName();
        $photo->move(public_path() . '/upload/education/', $photoname);

        $education['photo'] = $photoname;

        Education::create($education);

        return response()->json(['message' => true]);
    }

    public static function update_education($edu_id, $edu_data)
    {
        if (!empty($edu_data['photo'])) {
            $photo = $edu_data['photo'];
            $photo_name = uniqid() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('upload/education/'), $photo_name);
            $edu = Education::findOrFail($edu_id);
            $image_path = public_path() . '/upload/education/' . $edu->photo; //get image path location
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $edu_data['photo'] = $photo_name;
        }
        Education::findOrFail($edu_id)->update($edu_data);

        return response()->json(['message' => true]);
    }

    public static function delete_education($id)
    {
        
        $education = Education::findOrFail($id);
        $image_path = public_path() . '/upload/education/' . $education->photo;
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $education->delete();
        return response()->json(['message' => true]);
    }

}
