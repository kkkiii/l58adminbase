<?php
use Illuminate\Support\Str;
$tot = 0 ;
?>
@extends('layouts.customerbase')

@section('content')



    <div id="app2">


        <table class="table">
            <thead>
            <tr>
                <th>序号</th>
                <th>商品名称</th>
                <th>商品价格</th>
                <th>购买数量</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="iphone in Ip_Json">
                <td>@{{ iphone.id }}</td>
                <td>@{{ iphone.name }}</td>
                <td>@{{ iphone.price }}</td>
                <td>
                    <button v-bind:disabled="iphone.count === 0" v-on:click="iphone.count-=1">-</button>
                    @{{ iphone.count }}
                    <button v-on:click="iphone.count+=1">+</button>
                </td>
                <td>
                    <button v-on:click="iphone.count=0">移除</button>
                </td>
            </tr>
            </tbody>
        </table>

        <form @submit="formSubmit">
            @csrf


            <div class="card">
                选择地址
                <select name="shipping_address" class="form-control"  v-model="selected">

                    @foreach($addrs as $item )
                        <option  value="{{$item->id}}">{{$item->addr}}</option>
                    @endforeach

                </select>
            </div>



            <div class="card">
                <ul class="list-group">
                    <li class="list-group-item"> 合计:@{{totalPrice()}}</li>
                    <button type="submit" class="btn btn-primary">确认</button>
                </ul>
            </div>



        </form>

    </div>


@endsection


@section('js')
    <script>

        var app2 = new Vue({
            el: '#app2',
            data: {
                Ip_Json: [

                    @foreach($arr as $k =>$item)
                    @if($k>0)
                    ,
                    @endif
                    {{'{'}}
                    {{ "id:" .$item->templateid}} ,
                    name:  "{{$item->templatename}}"  ,
                {{ "price:" .$item->unit_price}},
        {{ "count:" .$item->code_amount}}

        {{'}'}}
        @endforeach

        ],
        selected:{{$selected}}


            },
        methods:{
            totalPrice : function(){
                var totalP = 0;
                for (var i = 0,len = this.Ip_Json.length;i<len;i++) {
                    totalP+=this.Ip_Json[i].price*this.Ip_Json[i].count;
                }
                return totalP;
            },

            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;
                axios.post('/customer/order.cart2ord', {
                    pvalue: this.Ip_Json,
                    addr: this.selected
                })
                    .then(function (response) {
                        currentObj.output = response.data.url ;
                        console.log(response.data) ;
                        $(location).attr('href',response.data.url)
                    })
                    .catch(function (error) {
                        currentObj.output = error;
                    });
            }


        }
        })

    </script>
@endsection
