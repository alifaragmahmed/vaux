 @extends('layouts.app')
 @section('title', 'Documentation')

 @section('css')
     <style>
         .doc-section .navbar-nav li {
             display: block;
             float: none !important;
         }

         .doc-section .navbar-nav li .category-name {
             font-size: 22px;
         }

         .doc-section .navbar-nav li .category-icon {
             font-size: 15px;
         }

         .article {
             display: none;
         }

     </style>
 @endsection
 @section('content')

     <!-- Main content -->
     <section class="content doc-section">
         <div class="w3-padding">
            <div class="jumbotron w3-white w3-text-green w3-padding w3-round-large">
                <div class="w3-xxlarge text-capitalize">
                    <b class="fa fa-laptop" style="margin: 5px;font-size: 36px!important;"></b>
                    {{ __('documentation') }}
                </div>
                <p class="w3-tiny">
                    {{ __('documentation sub title') }}
                </p>
            </div>
         </div>

         <div class="bs-example">
             <div class="row">
                 <div class="col-md-3">
                     <ul class="sidebar-menu tree">
                         @foreach ($categories as $item)
                             <li class="" style="margin-bottom: 5px">
                                 <a href="#" class="sidemen-item-a w3-white" onclick="showCategory('{{ $item->id }}')">
                                     <i class="{{ $item->icon }} category-icon fa sidebar-img"
                                         style="margin-left: 7px;margin-right: 7px"></i>
                                     <b class="category-name">{{ $item->title }}</b>
                                 </a>
                             </li>
                         @endforeach
                     </ul>
                 </div>

                 <div class="col-md-9">
                     <div class="scrollspy-example" data-spy="scroll" data-target="#navbar-example2" data-offset="0">
                         <br>
                         @foreach ($articles as $item)
                             <div class="article article-{{ optional($item->categories[0])->id }}">
                                <ol class="breadcrumb">
                                    @if ($item->parent_category)
                                    <li><a href="#" onclick="showCategory('{{ $item->parent_category }}')" >{{ $item->parent_category }}</a></li>
                                    @endif
                                    @if(count($item->categories) > 0)
                                    <li><a href="#" onclick="showCategory('{{ optional($item->categories[0])->id }}')" >{{ optional($item->categories[0])->title }}</a></li>
                                    @endif
                                    <li class="active">{{ $item->title }}</li>
                                </ol>
                                <br>
                                 <h4 id="{{ optional($item->categories[0])->id }}">
                                     {{ $item->title }}
                                 </h4>
                                 <p>
                                     {{ $item->content }}
                                 </p>
                             </div>
                         @endforeach

                     </div>
                 </div>
             </div>




         </div>

     </section>
     <!-- /.content -->
 @stop
 @section('javascript')


     <script>
         $('body').scrollspy({
             target: '#navbar-example2'
         })

         function showCategory(id) {
             var time = 300;
             $('.article').slideUp(time);
             $('.article-' + id).slideDown(time);
         }

         showCategory('{{ optional($categories[0])->id }}');
     </script>
 @endsection
