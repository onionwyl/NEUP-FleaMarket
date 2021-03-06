@extends('layout.master')

@section('title', "我的出售")

@section('asset')
    <style>
        h5 {
            color: #ffffff;
        }

        .trans_msg {
            filter: alpha(opacity=100) revealTrans(duration=.2, transition=1) blendtrans(duration=.2);
            width: 400px;
            height: 200px;
        }
    </style>
@endsection

@section('content')

    <h3>我的出售</h3>
    <ul class="tabs" data-tabs id="editinfo">
        <li class="tabs-title"><a href="#goods" aria-selected="true">我的商品</a></li>
        <li class="tabs-title"><a href="#trans">交易订单</a></li>
        <li class="tabs-title is-active"><a href="#tickets">历史评价</a></li>
    </ul>
    <div class="tabs-content" data-tabs-content="editinfo">
        <div class="tabs-panel" id="goods">
        </div>
        <div class="tabs-panel" id="trans">
        </div>
        <div class="tabs-panel" id="tickets">
            <div id="tickets-container" class="card-section">
                <ul>
                    @foreach($tickets as $ticket)
                        <li>
                            <label>{{ $ticket->created_at }}
                                @if($ticket->type == 1)
                                    评价
                                @else
                                    举报
                                @endif
                            </label>
                            <p>{{ $ticket->message }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script src="/js/good/ToolTip.js"></script>
    <script>
        function del_good(goodid) {
            if (confirm('确定删除吗？')) {
                var str_data1 = $('#delform').serialize();
                var str_data = str_data1 + '&_method=DELETE';
                $.ajax({
                    type: "POST",
                    url: "/good/" + goodid + "/delete",
                    data: str_data,
                    success: function (msg) {
                        $('#good' + goodid).slideUp();
                    }
                });
            }
        }
        $(document).ready(function () {
            $("a[href='#goods']").click(function () {
                window.location.href = "/user/sell";
            });
            $("a[href='#trans']").click(function () {
                window.location.href = "/user/sell/trans";
            });
        });
    </script>
@endsection