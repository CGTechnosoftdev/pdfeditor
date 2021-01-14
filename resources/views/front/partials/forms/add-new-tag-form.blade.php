<!-- Modal -->
@php
$tag_colors_arr = config('custom_config.tag_color_arr');
$default_active_color = reset($tag_colors_arr);
@endphp
<div class="modal fade more-options create-folder" id="add-tag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tags</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group existing-tags">
                    <label for="name">Added tags</label>
                    <dtv class="tags" id="added_tags">
                        No tags added
                    </dtv>
                </div>

                <div class="form-group tag-colors-here">
                    <label for="name">Tag Colors </label>
                    <ul>
                        @foreach($tag_colors_arr as $color)
                        <li class="tag-colors {{$default_active_color == $color ? 'active' : ''}}" data-color="{{$color}}">
                            <span style='background-color:{{ $color }}'></span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="form-group">
                    <label for="name">Add New Tag</label>
                    <input type="text" class="form-control" id="new_tag_name" value="" placeholder="Enter Tag Name" />
                </div>

                <div class="form-group existing-tags">
                    <label for="name">Select existing tags</label>
                    <dtv class="tags">
                        <span class="tag badge color1 use_existing_tag">Default Template</span>
                        <span class="tag badge color2 use_existing_tag">Form hosting</span>
                        <span class="tag badge color3 use_existing_tag">Guidebook</span>
                        <span class="tag badge color4 use_existing_tag">Signed Document</span>
                    </dtv>
                </div>

                <div class="share-link-btns">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success" id="save_tags">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('additionaljs')
<script>
    $(document).ready(function() {
        var active_color = "{{$default_active_color}}";
        $(document).on('click', '.tag-colors-here ul li', function() {
            active_color = $(this).attr("data-color");
            $(this).addClass('active').siblings().removeClass('active');
        });

        $(document).on('keypress', '#new_tag_name', function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var tag_value = $(this).val();
            if (keycode == '13') {
                if (tag_value.length > 0) {
                    addNewTag(tag_value, active_color);
                    $(this).val('');
                } else {
                    toastr.error("Tag name can't be empty");
                }
            }
        });

        $(document).on('click', '.use_existing_tag', function(event) {
            var color = $(this).css("background-color");
            var value = $(this).html();
            addNewTag(value, color);
        });

        $(document).on('click', '.remove_tag', function(event) {
            $(this).parent().remove();
            if ($('#added_tags').children().length == 0) {
                $('#added_tags').html("No tags added");
            }
        });

        $(document).on('click', '#save_tags', function(event) {
            var tags_arr = [];
            $('#added_tags').children().each(function() {
                var background = $(this).css("background-color");
                var html = $(this).text().trim();
                tags_arr.push({
                    "name": html,
                    "color": background
                });
            });
            // console.log(window.document);
            window.saveTags(window.selected_document, tags_arr);
        });

        function addNewTag(tag, color) {
            var tag_html = '<span class="tag badge" style="background-color:' + color + '">' + tag + '&nbsp;<i class="fa fa-times remove_tag"></i></span>';
            if ($('#added_tags').children().length > 0) {
                $('#added_tags').append("&nbsp;" + tag_html);
            } else {
                $('#added_tags').html(tag_html);
            }
        }
    });
</script>
@append