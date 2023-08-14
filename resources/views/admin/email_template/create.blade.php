<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Email Template') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <form method="POST" action="{{ route('email_templates.store') }}" class="form" novalidate data-parsley-validate="">
                    
                    @csrf

                    <div class="form-row">

                        <div class="label-block">
                            <label for="template_title">Template Title<span style="color:#F00">*</span></label>
                        </div>

                        <div class="input-block">
                            <input type="text" name="template_title" id="template_title" class="text-input focus:shadow-outline @error('template_title') is-invalid @enderror" value="<?=!empty($email_template->template_title)?$email_template->template_title:''?>" autocomplete="off" required/>
                            @error('template_title')
                                <p class="help invalid-feedback">{{ $errors->first('template_title') }}</p>
                            @enderror
                        </div>

                    </div>
                    <div class="form-row">

                        <div class="label-block">
                            <label for="template_subject">Template Subject<span style="color:#F00">*</span></label>
                        </div>

                        <div class="input-block">
                            <input type="text" name="template_subject" id="template_subject" class="text-input focus:shadow-outline @error('template_subject') is-invalid @enderror" value="<?=!empty($email_template->template_subject)?$email_template->template_subject:''?>" autocomplete="off" required/>
                            @error('template_subject')
                                <p class="help invalid-feedback">{{ $errors->first('template_subject') }}</p>
                            @enderror
                        </div>

                    </div>
                     <div class="form-row">

                        <div class="label-block">
                            <label for="template_content">Mail Content<span class="asctric">*</span></label>
                        </div>

                        <div class="input-block">
                            <textarea name="template_content" id="template_content" class="text-input focus:shadow-outline @error('template_content') is-invalid @enderror" value="{{ old('template_content') }}" autocomplete="off" style="height: 150px;" required/><?=!empty($email_template->template_content)?$email_template->template_content:''?></textarea>
                            @error('template_content')
                                <p class="help invalid-feedback">{{ $errors->first('template_content') }}</p>
                            @enderror
                        </div>

                    </div>  
                    <div class="form-row">

                        <div class="label-block">
                            <label for="template_unique_id">Template Unique Id<span style="color:#F00">*</span></label>
                        </div>

                        <div class="input-block">
                            <input type="text" name="template_unique_id" id="template_unique_id" class="text-input focus:shadow-outline @error('template_unique_id') is-invalid @enderror" value="<?=!empty($email_template->template_unique_id)?$email_template->template_unique_id:''?>" autocomplete="off" required/>
                            @error('template_unique_id')
                                <p class="help invalid-feedback">{{ $errors->first('template_unique_id') }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="label-block">
                            <label for="role">Status</label>
                        </div>

                        <div class="input-block">

                            <select class="text-input appearance-none focus:shadow-outline" name="template_status" id="template_status">
                                <option <?=(!empty($email_template->template_status) && $email_template->template_status == '1')?'selected="selected"':''?> value="1">Active</option>
                                <option <?=(!empty($email_template->template_status) && $email_template->template_status == '0')?'selected="selected"':''?> value="0">Deactive</option>
                            </select>
                           @error('status')
                                <p class="help invalid-feedback">{{ $errors->first('status') }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="label-block md:mb-0 md:w-4/5">
                           
                        </div>

                        <div class="input-block md:w-1/5">
                            <a href="/admin/email_templates/" class="btn-cancel focus:shadow-outline hover:bg-gray-300" type="button">Cancel</a>
                            <input class="btn-submit focus:shadow-outline hover:bg-blue-600" type="submit" value="Save" />
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
 <script type="text/javascript" src="{{URL::asset('/js/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
$(document).ready(function() {
    CKEDITOR.replace( 'template_content',
    {
        uiColor : '#cccccc',
        toolbar : 'Basic'
    });
    
});
</script>         
</x-admin-layout>
