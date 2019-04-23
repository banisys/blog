<?php

namespace App\Http\Controllers;

use App\Models\Articles\Article;
use App\Models\Videos\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDO;

class HomeController extends Controller
{



    public function index()
    {
//        $db=new PDO('mysql:host=localhost;dbname=blog','root','',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
//
//
//        $sql="select * from articles";
//        $stmt=$db->prepare($sql);
//        $stmt->execute();
//
//        $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
//        $results=collect($results);
//
//        dd($results[0]);
//        $x=array();
//        $c=0;
//        foreach ($results as $result){
//
//            $x[$c]=$result['slug'];
//            $c++;
//        }
//        dd($x);



        $articles = Article::latest()->paginate(10);

        return view('articles.index' , compact('articles'));
    }

}
