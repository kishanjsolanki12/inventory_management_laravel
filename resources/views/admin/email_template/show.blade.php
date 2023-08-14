<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Email Template') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">

              

                    @csrf
                    {{ method_field('PUT') }}

                    <div class="form-row">

                        <div class="label-block">
                            <label for="name">Template Title</label>
                        </div>

                        <div class="input-block">
                          <?=!empty($email_template->template_title)?$email_template->template_title:''?>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="label-block">
                            <label for="email">Template Subject</label>
                        </div>

                        <div class="input-block">
                            <?=!empty($email_template->template_subject)?$email_template->template_subject:''?>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="label-block">
                            <label for="role">Mail Content</label>
                        </div>

                        <div class="input-block">
                            <?=!empty($email_template->template_content)?$email_template->template_content:''?>
                        </div>

                    </div>
                     <div class="form-row">

                        <div class="label-block">
                            <label for="email">Status</label>
                        </div>

                        <div class="input-block">
                            <?=(!empty($email_template->template_status) && $email_template->template_status == '1')?'Active':''?>
                             <?=($email_template->template_status == '0')?'Deactive':''?>
                        </div>

                    </div>
                   <div class="form-row">

                        <div class="label-block">
                            <label for="email">Template Unique Id</label>
                        </div>

                        <div class="input-block">
                            <?=!empty($email_template->template_unique_id)?$email_template->template_unique_id:''?>
                        </div>

                    </div>

                    </div>
                    <div class="form-row">

                        <div class="label-block md:mb-0 md:w-4/5">
                           
                        </div>

                        <div class="input-block md:w-1/5 sub-class">
                            <a href="/admin/email_templates/" class="btn-cancel focus:shadow-outline hover:bg-gray-300" type="button">Cancel</a>

                            
                        </div>

                    </div>


            </div>
        </div>
    </div>
   
</x-admin-layout>
