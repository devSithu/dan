<?php


namespace App\CustomClass;


use App\News;

class NewData
{

    private $news_data;

    function __construct($news_id)
    {
        $news = News::findOrFail($news_id);
        $this->setNewData($news);
    }

    /**
     * @return mixed
     */
    public function getNewData()
    {
        $photo_url=DAN::$domain_url.'upload/news/'.$this->news_data['photo'];
        $this->news_data['photo']= $photo_url;
        return $this->news_data;
    }

    /**
     * @param mixed $blog_data
     */
    private function setNewData($news_data)
    {

        $this->news_data = $news_data;
    }

    public static function format($arr){
        $data=[];
        foreach ($arr as $news) {
            $obj=new NewData($news['id']);
            array_push($data,$obj->getNewData());
        }
        return $data;
    }

    public static function create_news($news)
    {
        
            $photo = $news['photo'];
            $photoname = uniqid() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path() . '/upload/news/', $photoname);

            $news['photo'] = $photoname;

            $created= News::create($news);
        
        // // return $created->exists
        return response()->json($created);
    }

    public static function update_news($news_id,$news_data)
    {

        if (!empty($news_data['photo'])) {
            $photo = $news_data['photo'];
            $photo_name = uniqid() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('upload/news/'), $photo_name);
            $news = News::findOrFail($news_id);
            $image_path = public_path() . '/upload/news/' . $news->photo;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            //array_push($news_data,$photo_name);
            $news_data['photo'] = $photo_name;
        } 
        $news=News::findOrFail($news_id)->update($news_data);
        
        return response()->json(['message' => $news]);
    }

    public static function delete_news($id)
    {
        $news = News::findOrFail($id);
        $image_path = public_path() . '/upload/news/' . $news->photo;
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $deleted=$news->delete();

        return response()->json(['message' => $deleted]); 
    }

}