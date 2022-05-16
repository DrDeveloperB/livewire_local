@extends('layouts.base')

@section('content')

<div class="flex justify-center">

    <div class="my-10 flex">
        <div class="p-2 rounded border">
            <div class="">
                <label for="content" class="">Content</label>
                <div name="content" id="content" class="">
                    {{ $po[0]->po_content }}
                </div>
            </div>
            <div>
                <button onclick="seeHtml();">html보기</button>
                <button onclick="seeMd();">markdown보기</button>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    // Editor.defineExtension('myExt', instance => { // 익스텐션 정의
    //     instance.setMarkdown('# Hello Hands on Labs!');
    // });

    let editor;
    window.onload = function () {
        // console.log(Editor)

        const editor_instance = new ToastEditor({
            el: document.querySelector('#content'),     // 에디터가 생성되는 컨테이너 엘리먼트 지정
            initialEditType: 'wysiwyg',        // 에디터 초기 모드를 지정 ('markdown' 또는 'wysiwyg')
            // previewStyle: 'tab',           // 마크다운 모드는 편집 중인 콘텐츠의 모습을 미리 볼 수 있는 프리뷰의 UI 형태를 지정 ('tab' 또는 'vertical')
            // theme: 'dark',
            height: '400px',        // 에디터 편집 영역의 높이 지정
            // placeholder: 'Write something cool!',
            // initialValue: '# hello \n> world',       // 에디터에 초기 콘텐츠 값을 마크다운 텍스트로 지정
            // initialValue: '&lt;iframe width=&quot;330&quot; height=&quot;250&quot; src=&quot;https://www.youtube.com/embed/TlMlUo2RIrE&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture&quot; allowfullscreen=&quot;&quot;&gt;&lt;/iframe&gt;',
            // initialValue: "@{{ $po[0]->po_content }}",
            plugins: [
                // [ToastChart, chartOptions],
                // [ToastHighlight, { highlighter: Prism }],
                [ToastColor],
                [ToastMergedCell],
            ],
        });
        editor = editor_instance;

        // editor.setHTML('<h1>Hello TOAST UI Editor!</h1>');
        // alert(editor.getHTML());

        // editor.setMarkdown('# Hello NHN Forward!');
        // alert(editor.getMarkdown());
    };

    const seeHtml = function(){
        alert(editor.getHTML());
    }
    const seeMd = function(){
        alert(editor.getMarkdown());
    }
</script>

@endsection
