@extends('layouts.adminbase')

@section('content')
    <div id="app">
        <p v-if="seen">现在你看到我了</p>
        <template v-if="ok">
            <h1>菜鸟教程</h1>
            <p>学的不仅是技术，更是梦想！</p>
            <p>哈哈哈，打字辛苦啊！！！</p>
        </template>

        <div v-if="type === 'A'">
            A
        </div>
        <div v-else-if="type === 'B'">
            B
        </div>
        <div v-else-if="type === 'C'">
            C
        </div>
        <div v-else>
            Not A/B/C
        </div>
    </div>
@endsection


@section('js')
    <script type="text/javascript">
        new Vue({
            el: '#app',
            data: {
                seen: true,
                ok: true
            }
        })
    </script>
@endsection