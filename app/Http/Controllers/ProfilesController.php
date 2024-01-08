<?php

namespace App\Http\Controllers;
use App\Models\User;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
class ProfilesController extends Controller
{
    //
    
    public function index($user)
    {
         $userl = User::FindorFail($user);
        $users = Auth::User();
        $follows = $users ?  $users->following->contains($user) : false;
       
        // $postCount = Cache::remember('count.posts.', $userl->id,
        // now()->addSeconds(30), function () use ($userl){
        //   return $userl->posts->count();
        // });
        $postCount = Cache::remember('count.posts', $userl->id, function () use($userl){
            return $userl->posts->count();
        });
        $followersCount = Cache::remember('count.followers', $userl->id, function () use($userl){
            return $userl->profile->followers()->count();
        });
        $followingCount = Cache::remember('count.followeing', $userl->id, function () use($userl){
            return $userl->following()->count();
        });
        return view('profile.index',compact('userl','follows','postCount','followersCount','followingCount'));
    }
    public function edit(User $user){
        $this->authorize('update',$user->profile);

        return view('profile.edit',compact('user'));
    }
    public function update(Request $request,User $user){
         $this->authorize('update',$user->profile);
        $user = Auth::User();
        
        $data = $request->validate([
            'title'=>'',
            'description'=>'',
            'url'=>'nullable|url',
            'avatar'=>'image|mimes:jpeg,jpg|max:20048',
            // 'username'=>['max:10']
        ]);
        
       
        if ($request->hasFile('avatar') ) {
            $avatar = $request->file('avatar')->getClientOriginalName();
            $fileName = pathinfo($avatar,PATHINFO_FILENAME);
   
            $extension = $request->file('avatar')->getClientOriginalExtension();
      
            $fileNameStore = $fileName  . time() . '.' . $extension;
         
            $request->file('avatar')->storeAs('public/profile',$fileNameStore);
            $avatar = 'storage/profile/'.$fileNameStore;
        //  dd($profilePath);
            $img = Image::make($avatar)->fit(100,100)->save($avatar);
            

        }
        else{
            $avatar = $user->profile->profileAvatar();
          }
          $user->profile->update([
            'title'=>$data['title'],
            'description'=>$data['description'],
            'url'=>$data['url'],
            'avatar'=>$avatar,
          ]);

        return redirect('profile/'.$user->id)->with('user');
    }
}
