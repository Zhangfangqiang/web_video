@extends(env('VIEWLAYER').'.layouts.app')

{{--后置css样式开始--}}
@section('after_css')

@endsection
{{--后置css样式结束--}}

{{--header头部内容开始--}}
@section('header')

@endsection
{{--header头部内容结束--}}

{{--中间内容开始--}}
@section('content')
  <table class="table table-striped js-check-wrap">
    {{--表格头部开始--}}
    <thead>
    <tr>
      <th scope="col" style="width: 15%">
        <input type="checkbox" class="js-check-all" data-direction="x" data-checklist="js-check-x">
      </th>
      <th scope="col" style="width: 20%">
        编号
      </th>
      <th scope="col" style="width: 65%">分类</th>
    </tr>
    </thead>
    {{--表格头部结束--}}

    {{--表格中间内容开始--}}
    <tbody>
    {{--循环开始--}}
    @if(count($categories))
      @foreach($categories as $key => $value)
        <tr class="data-item-tr">
          <td scope="row">
            <input type="checkbox" class="js-check" data-yid="js-check-y" @if(is_array($ids) && in_array($value->id , $ids)) checked @endif data-xid="js-check-x" name="ids[]" value="{{$value->id}}" data-name="{{$value->name}}">
          </td>
          <td>
            {{$key+1}}
          </td>
          <td>
            <span class="text-danger">{{ str_repeat('---', ($value->level) )}}</span>
            {{$value->name}}
          </td>
        </tr>
      @endforeach
    @endif
    {{--数据循环结束--}}
    </tbody>
    {{--表格中间内容结束--}}
  </table>
@endsection
{{--中间内容结束--}}

{{--footer脚部内容开始--}}
@section('footer')

@endsection
{{--footerr脚部内容结束--}}

{{--后置js开始--}}
@section('after_js')
  <script>
    /**
     * 数据准备的方法,这个方法是让父窗口调用的
     * @returns {selectedCategories: [], selectedCategoriesName: [], selectedCategoriesId: []}
    */
    function dateReady() {
      var selectedCategoriesId   = [];      //分类id
      var selectedCategoriesName = [];      //分类名称
      var selectedCategories     = [];      //选中分类集

      $('.js-check:checked').each(function () {
        var $this = $(this);
        selectedCategoriesId.push($this.val());
        selectedCategoriesName.push($this.data('name'));

        selectedCategories.push({
          id: $this.val(),
          name: $this.data('name')
        });
      });

      return {
        selectedCategories    : selectedCategories,
        selectedCategoriesId  : selectedCategoriesId,
        selectedCategoriesName: selectedCategoriesName
      };
    }
  </script>
@endsection
{{--后置js结束--}}
