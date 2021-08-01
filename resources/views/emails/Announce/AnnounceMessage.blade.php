@component('mail::message')
<h1>通知訊息</h1>
<div>{{$class->name_cn}}課程公告通知</div>
<p>
    您報名的{{$class->name_cn}}課程有新的公告, 請記得查看
    <a href="http://127.0.0.1:8000/admin/class/announce/{{$class->id}}">點我快速查看</a>
</p>
@endcomponent
