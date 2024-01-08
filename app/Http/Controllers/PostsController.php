<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use Image;
class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $user = Auth::User();
        $users = $user->following()->pluck('profiles.user_id');
        $posts = Post::WhereIn('user_id',$users)->latest()->with('user')->get();
        return view('posts.index',compact('posts'));
    }
    public function create(){
        return view('posts.create');
    }
    public function store(Request $request){
        $user = Auth::User();
        $data = $request->validate([
            'caption'=>'required',
            'image'=>'required|image|mimes:jpeg,jpg|max:20048'
        ]);
        // dd($request->file('image')->store('uploads','public'));


        // if($request->hasFile('image')){
            
        //     $file = $request->file('image');
        //     $fileName = $file->getClientOriginalName();
        //     $filePath = time().'.'.$fileName;
          
        //     $destinationPath = "storage/thumbnail/";
        //     $newImage = Image::make($file)->fit(100, 100,)->save($destinationPath.$fileName);
            
            
        //     $newImage = $file->move($destinationPath, $fileName);
        //     dd($newImage);
          
        //     $post = $user->posts()->create([
        //         'user_id'=>$user['id'],
        //         'caption'=>$data['caption'],
        //         'image'=> $newImage,
        //     ]);
           
        //     // return back()
        //     //     ->with('success','Image has successfully uploaded.')
        //     //     ->with('fileName',$input['image']);
        
        // }

        if ($request->hasFile('image')) {
            $postImage = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($postImage,PATHINFO_FILENAME);
   
            $extension = $request->file('image')->getClientOriginalExtension();
      
            $fileNameStore = $fileName  . time() . '.' . $extension;
         
            $request->file('image')->storeAs('public/thumbnail',$fileNameStore);
            $thumbnailPath = 'storage/thumbnail/'.$fileNameStore;
            // dd($thumbnailPath);
            $img = Image::make($thumbnailPath)->fit(325,325)->save($thumbnailPath);
            // $request->file('image')->storeAs('posts/', $postImage);
            // $post->update(['image' => $postImage]);
    
            // $file=Image::make($request->file('image'))->fit(300, 200);
            // $file->resize(450, null, function ($constraint) {
            //     $constraint->aspectRatio();
            // });
            // $file->save('app/public/posts/' .  '/thumbnail_' . $postImage);
            $post = $user->posts()->create([
                'user_id'=>$user['id'],
                'caption'=>$data['caption'],
                'image'=> $thumbnailPath,
            ]);
        }
 


        // Post::create($data);
        return redirect('profile/'.$user->id)->with('user','posts');
    }

    public function show(Post $post){
        return view('posts.show',compact('post'));
    }
    public function delete(Post $post){
        $user = Auth::User();
       
        Post::destroy($post->id);
       
        return redirect('profile/'.$user->id);
    }
    
}
