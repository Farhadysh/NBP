<div class="profile-sidebar close-profile" id="toggle-profile">
    <div class=" hidden">
        <h5 class="text-secondary d-flex align-items-center mt-3"><i class="fa fa-id-card pl-3"></i> پروفایل من
        </h5>
    </div>

    <div class="borer-profile-sidebar mt-md-5 py-3 shadow-sm">
        <form action="{{route('user.profileImage')}}"
              method="post" enctype="multipart/form-data">
            @csrf
            <div class="image-box2 rounded-circle mx-auto border {{$errors->has('image') ? 'border-danger' : ''}}"
                 style="width: 40%">
                <input type="file" name="image" id="profile">
                <img class="rounded-circle" id="profileImage" alt="عکس کاربر"
                     src="{{asset($user->image ? $user->image : '/image/user.png')}}" width="90" height="90">
            </div>
            <button type="submit" class="btn btn-sm btn-outline-info px-5 mt-2">تغییر</button>
        </form>
        <p class="text-secondary my-4">{{$user->name}} {{$user->last_name}}</p>
        <div>
            <form action="{{route('logout')}}" method="post">
                @csrf
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-outline-danger btn-sm"> خروج از حساب
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="side-menu shadow-sm">
        <h5 class="text-secondary p-3 mb-0">حساب کاربری شما</h5>
        <ul>
            <li><span class="fa fa-user pl-3"></span> <a href="/user/profileEdit"> پروفایل من </a></li>
            <li><span class="fa fa-dolly pl-3"></span> <a
                        href="{{route('user.showOrders',['id'=>$user->id,'سفارشات'])}}"> سفارشات </a></li>
        </ul>
    </div>
</div>