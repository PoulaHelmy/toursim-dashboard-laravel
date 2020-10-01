@extends('layouts.dashboard.app')

@section('content')
    <div class="content-wrapper " style="color:#000 !important;">

        <section class="content" style="color:#000 !important;">
            <div class="example example_markup" style="color:#000 !important;">
                <h3>Markup</h3>
                <p>Just add <code>data-role="tagsinput"</code> to your input field to
                    automatically change it to a tags input field.</p>
                <div class="bs-example">
                    <input type="text" value="Amsterdam,Washington,Sydney,Beijing,Cairo"
                           data-role="tagsinput"/>
                </div>
                <div class="accordion">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse"
                               href="#accordion_example_markup">
                                Show code
                            </a>
                        </div>
                        <div id="accordion_example_markup" class="accordion-body collapse">
                            <div class="accordion-inner highlight">
                                <pre><code data-language="html">&lt;input type=&quot;text&quot; value=&quot;Amsterdam,Washington,Sydney,Beijing,Cairo&quot; data-role=&quot;tagsinput&quot; /&gt;</code></pre>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>statement</th>
                        <th>returns</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><code>$("input").val()</code></td>
                        <td>
                            <pre class="val"><code data-language="javascript"></code></pre>
                        </td>
                    </tr>
                    <tr>
                        <td><code>$("input").tagsinput('items')</code></td>
                        <td>
                            <pre class="items"><code data-language="javascript"></code></pre>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </section>
    </div><!-- end of box body -->
    </div><!-- end of box -->
    </section><!-- end of content -->
    </div><!-- end of content wrapper -->


@endsection
