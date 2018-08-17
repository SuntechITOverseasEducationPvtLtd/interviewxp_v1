
@extends('front.layout.main')
@section('middle_content')
    <div id="header-home" class="home-header"></div>
    <div class="banner-member">
        <div class="pattern-member about-banner">

        </div>
    </div>

    <!-- middle section -->
    <div class="middle-area max-height">
        <div class="container">
            <div class="privacy-page">
                <div class="privacy-top">
                    <h2>{{$page_title}}</h2>

                </div>

                @if(isset($arr_data) && sizeof($arr_data)>0)
                    <?php echo html_entity_decode($arr_data['page_desc'], ENT_QUOTES, 'UTF-8');?>
                @else
                   <p>Record Not Found</p>
                @endif
              

                <!-- <h3>Inetrviewxp Terms and Conditions</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>


                <h3>The use of this website is subject to the following terms of use</h3>
                <P>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</P>


                <h3>The content of the pages of this Website</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p> -->


            </div>
        </div>
    </div>


    <!--footer section-->
@endsection
