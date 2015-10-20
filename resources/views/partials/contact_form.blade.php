<div class="contact_form">
    
    @include('errors.validation')
    
    {!! Form::open(array('action' => 'WebsiteController@contactFormSend')) !!} 
    
        <fieldset>
            <div class="form-group">
                <div >
                    <input id="formName" name="name" type="text" placeholder="Name" class="form-control input-xlarge" value="{{ old('name') }}">
                    <br /><br />
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-4">
                    <input id="formCompany" name="company" type="text" placeholder="Company" class="form-control input-xlarge" value="{{ old('company') }}">
                    <br /><br />
                </div>
            </div>
             <div class="form-group">
             <div class="col-md-4">
                    <input id="formTel" name="phone" type="tel" placeholder="Tel" class="form-control input-xlarge" value="{{ old('phone') }}">
                    <br /><br />
                </div>
            </div>
            <div class="form-group">
             <div class="col-md-4">
                    <input id="formEmail" name="email" type="email" placeholder="E-mail" class="form-control input-xlarge" value="{{ old('email') }}" >
                    <br /><br />
                </div>
            </div>
             <div class="form-group" id="contact-textarea">
             <div class="col-md-4">
                 <textarea class="form-control input-xlarge" rows="5" placeholder="Content"  id="content" name="message" >{{ old('message') }}</textarea>
                    <br /><br />
                </div>
            </div>
             <div class="form-group">
                <div class="contact-sendButton">
                    <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary btn-lg btn-warning">
                </div>
            </div>
        </fieldset>
    {!! Form::close() !!}
</div>