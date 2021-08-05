@extends('layouts.default')

@section('title',$seo->title)
@section('keywords',$seo->keywords)
@section('description',$seo->description)

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">
    <style>
        #calendar{
            margin-top: 30px;
        }

        .fc-content{
            cursor: pointer;
        }

        .summer-note-content{
            margin-top:30px;
        }

        .summer-note-content table , .summer-note-content img{
            max-width: 100%;
        }
    </style>
@endsection

@section('content')
    <div id='calendar'></div>

    <div id="calendar_modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/locale/zh-tw.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script>
        $(function() {

            // page is now ready, initialize the calendar...

            $('#calendar').fullCalendar({
                themeSystem: 'bootstrap4',
                header: {
                    left: 'prev,next ',
                    center: 'title',
                    right: 'today'
                },
                events: '/calendar_api',
                eventClick: function(event) {
                    if (event.id) {
                        $('.modal-body').html('<i class="fas fa-spinner fa-spin"></i>');
                        $('.modal-title').html(event.title);
                        $('#calendar_modal').modal('toggle');
                        $('.modal-body').load('/calendar_detail_api/'+event.id);
                        return false;
                    }
                }
            })

        });
    </script>
@endsection