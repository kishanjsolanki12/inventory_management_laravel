<?php $dash.='-- '; ?>
@if((!$category->isEmpty()))
     @foreach ($category as $row)
        <tr class="border-b border-gray-200">
            <td class="border px-8">{{$dash}}{{ $row->category_name }}</td>
            <?php  if(!Auth::user()->hasRole('Vendor')) { ?>
            <td class="border px-8">{{ $row->vendor_name }}</td>
            <?php } ?>
            <td class="border px-8">@if($row->parent_id){{ $row->parent->category_name }} @else No Parent Category @endif</td>
            <!-- <td class="border px-8">@foreach($row->_nLevelCat as $sub_catgory)

                                                    <li>{{$sub_catgory->category_name}}</li>

                                            @endforeach</td> -->
            <?php if(!empty($row->category_image)){ ?>
            <td><img data-dz-thumbnail="" alt="productlisting.png" src="{{ asset('/category_images/'.$row->category_image) }}" style="height: 100px; width: 100px;"></td>
            <?php }else { ?> <td> </td> <?php } ?>

            <td class="border px-8 text-center">

                <form method="POST" action="{{ route('category.destroy', $row->id) }}" class="">
                        @csrf
                        {{ method_field('DELETE') }}
                        <!-- <a href="/admin/rows/{{ $row->id }}/show" class="bg-primary text-white p-2 ml-2  approval"><i class="fa fa-eye" title="View"></i></a>
 -->
                      <a href="/admin/category/{{ $row->id }}/edit" class="bg-success mr-3 text-white p-2 ml-2 "><i class="fa fa-edit text-white" title="Edit"></i></a>
                         <?php if($row->id != 1){ ?>
                        <button class="bg-danger text-white p-1 px-2 ml-2 " onclick="return confirm('Are you sure you want to delete?');">
                        <i class="fa fa-trash text-white" title="Delete"> </i>
                        </button>
                       <?php } ?>

                </form>
            </td>
        </tr>

        @if(count($row->_nLevelCat))

        @include('admin.category.sub-category-list',['category' => $row->_nLevelCat])
    @endif
    @endforeach
@else
    <tr>
       <td colspan="5" align="center">
        No Data Found.
       </td>
    </tr>
@endif
<tr>
   <td colspan="5" align="center">
    <div class="pagination">


    </div>
   </td>
</tr>