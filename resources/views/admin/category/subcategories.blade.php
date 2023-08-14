<?php $dash.='-- '; ?>

@foreach ($sub_category_name as $row)
                                                        
    <option <?=(!empty($category[0]->parent_id) && $category[0]->parent_id == $row->id)?'selected="selected"':''?> value="{{ $row->id }}">{{$dash}}{{ $row->category_name }} </option>
    
    @if (count($row->_nLevelCat))
    @php
            // Creating parents list separated by ->.
            $parents = $parent . '->' . $row->name;
        @endphp
        @include('admin.category.subcategories', ['sub_category_name' => $row->_nLevelCat, 'parent' => $parents])
    @endif

@endforeach