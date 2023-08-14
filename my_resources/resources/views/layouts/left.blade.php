<?php 
$categories  = \App\Models\Category::where('parent_id', 0)->with('children')->paginate(100);
?>

<div class="col-md-4">
  <ul class="left-menu wp-float">
     @if(!empty($categories))
     <?php $i = 1; ?>
        @foreach ($categories as $category)
    <li class="active"><b><span>{{$i++}}</span> <a id="" href="{{ url('category/'.$category->id) }}">{{ $category->name }}</a></b></li>
    @foreach ($category->children as $child)
    <li>    <a id="child{{ $child->id }}" href="{{ url('category/'.$child->id) }}">{{ $child->name }}</a></li>
    
    <hr />
         @endforeach
         
    @endforeach
    <?php $i++; ?>
 @endif
  </ul>

</div>