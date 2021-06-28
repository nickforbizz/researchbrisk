@extends('layouts.frontend')



@section('content')

    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-sm-12 -bottom-8">
                <h5 class="primary-color btr-6 p-3">Order Assignment !!!</h5>
            </div>
            <div class="col-sm-12">
                <div class="card p-3">
                    <form
                        enctype="multipart/form-data"
                        id="nil_order"
                        class="form row"
                    >
                        <input type="hidden" name="user_id" value="00" /><input
                            type="hidden"
                            name="nil"
                            value="Y"
                        />
                        <div class="form-group col-sm-4">
                            <label for="email">Email</label
                            ><input
                                id="email"
                                name="email"
                                type="text"
                                class="form-control"
                                placeholder="Enter Email"
                            />
                        </div>
                        <div class="form-group col-sm-8">
                            <label for="title">Title</label
                            ><input
                                id="title"
                                name="title"
                                type="text"
                                class="form-control"
                                placeholder="Enter Title"
                            />
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="category">Category</label
                            ><select
                                id="category"
                                class="form-control browser-default"
                                name="category_id"
                                required
                            >
                                <option selected disabled="">
                                    Choose your option
                                </option>
                                @foreach($categories as $cats)
                                    <option value="{{ $cats->id }}"> {{ $cats->id }} - {{ $cats->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="format">Format</label
                            ><select
                                id="format"
                                class="form-control browser-default"
                                name="format_id"
                                required
                            >
                                <option selected disabled="">
                                    Choose your option
                                </option>
                                @foreach($formats as $format)
                                    <option value="{{ $format->id }}"> {{ $format->id }} - {{ $format->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="language">Language</label
                            ><select
                                id="language"
                                class="form-control browser-default"
                                name="language_id"
                                required
                            >
                                <option selected disabled="">
                                    Choose your option
                                </option>
                                <option value="1"> 1 - English </option>
                                <option value="2"> 2 - Kiswahili </option>
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="pages">Page(s)</label
                            ><input
                                id="pages"
                                name="pages"
                                type="number"
                                class="form-control"
                                placeholder="Enter Pages"
                            />
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="word_count">Word Count</label
                            ><input
                                id="word_count"
                                name="word_count"
                                type="number"
                                class="form-control"
                                value="275"
                            />
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="notes">Notes</label
                            ><textarea
                                id="notes"
                                name="notes"
                                class="form-control"
                                placeholder="Enter Additional Info"
                            ></textarea>
                        </div>
                        <div class="form-group col-sm-12">
                            <p>
                                Documents
                                <small>
                                    <i>
                                        - (hold CTRL to select multiple docs)</i
                                    ></small
                                >
                            </p>
                            <input
                                type="file"
                                id="docs"
                                class="form-control"
                                name="file"
                                multiple=""
                            />
                        </div>
                        <br />
                        <div class="input-field col s12">
                            <input class="btn btn-success" type="submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#pages").change(() => {
                let pages = parseInt($("#pages").val());
                $("#word_count").val(pages * 275);
            })
        })
    </script>
@endsection