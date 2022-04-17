@extends('admin.layouts.main')
@section('title', 'AdminLTE | Slider')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Update Slider</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.slider')}}">Sliders</a></li>
              <li class="breadcrumb-item active">Update Slider</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      <!-- Update slider form start -->
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="slider-img mb-3 mt-3 d-flex justify-content-center">
                <img src="{{$slider->getImage($slider->slider_img)}}" class="img-thumbnail" alt="slider-img" style="width: 100px; height: 100px; object-fit: cover;">
            </div>
            <form action="{{route('admin.update-slider', $slider->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container-fluid">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="sliderTitle">Title</label>
                            <input type="text" name="slider_title" value="{{$slider->slider_title}}" class="form-control" id="sliderTitle">
                        </div>
                        <div class="form-group">
                            <label for="sliderTitle">Description</label>
                            <input type="text" name="slider_description" value="{{$slider->slider_description}}" class="form-control" id="sliderTitle">
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                          <div class="custom-control custom-switch">
                            <input type="radio" class="custom-control-input" {{($slider->slider_status === 'active') ? 'checked' : ''}} id="activeSlider" name="status_slider" value="active">
                            <label class="custom-control-label" for="activeSlider">Active</label>
                          </div>
                          <div class="custom-control custom-switch">
                            <input type="radio" class="custom-control-input" {{($slider->slider_status === 'passive') ? 'checked' : ''}} id="passiveSlider" name="status_slider" value="passive">
                            <label class="custom-control-label" for="passiveSlider">Passive</label>
                          </div>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" {{($slider->slider_btn_status === 'active') ? 'checked' : null}} name="slider_btn_status" class="custom-control-input  slider-status" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">Btn status</label>
                        </div>
                        <div class="toggle-slider-btn">
                          <div class="d-flex justify-content-between align-items-center slider-btn-blog">
                              <div class="form-group">
                                <label for="sliderBtnText">Btn text</label>
                                <input type="text" name="slider_btn_text" value="{{$slider->slider_btn_text}}" class="form-control" id="sliderBtnText">
                              </div>
                              <div>
                                  <label for="sliderBtnColor">Btn Color</label><br>
                                  <input type="color" value="{{$slider->slider_btn_color}}" name="slider_btn_color" id="sliderBtnColor">
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                      <div class="file-upload">
                          <div class="image-upload-wrap">
                            <input class="file-upload-input" type='file' name="slider_image" onchange="readURL(this);" accept="image/*" />
                            <div class="drag-text">
                              <h3>File upload to here</h3>
                            </div>
                          </div>
                          <div class="file-upload-content">
                            <img class="file-upload-image" src="#" alt="your image" />
                            <div class="image-title-wrap">
                              <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                            </div>
                          </div>
                        </div>
                      </div>
                         
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Create</button>  
                </div>
            </form>
            </div>
        </div>
    </div>
      <!-- Update slider form end -->
@endsection