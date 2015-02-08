<h1>Validator <span>\Exedra\Application\Utilities\Validator</span></h1>
<p>Exedra provides you a very simple validator, that you may simply use for validating data. </p>
<h2>1. Writing Validation</h2>
<p>Consider these data, with some example value : </p>
<pre><code>
$input['username'] = '';
$input['userEmail'] = 'my@email@aa.com';
$input['userAddress'] "This is my address";
</code></pre>
<h3>1.1 Writing rules :</h3>
<h4>1.1.1 Validate all</h4>
<pre><code>
$rules = array('_all'=> 'required:This data is required');
</code></pre>
<h4>1.1.2 Validate email</h4>
<pre><code>
$rules['userEmail'] = 'email:This email format is wrong!';
</code></pre>
<h4>1.1.3 Validate all with exception</h4>
<p>Validate all fields except the specified ones</p>
<pre><code>
$rules['except:address'] = 'required:this field is required.';
</code></pre>
<h4>1.1.4 Multiple validation</h4>
<pre><code>
$rules['email'] = array(
		'required:this field is required',
		'email:This email field format is wrong'
	);
</code></pre>
<h4>1.1.5 Callback.</h4>
<pre><code>
$rules['username'] = array(
	'callback'=>[validateUsername('eimihar'), 'Unable to find this username']
);
</code></pre>
<h3>1.2 Validate</h3>
<p>The validate method returns an array of errors containing fields as the keys, against the messages, if there're errors in the validation form.</p>
<pre><code>
if($errors = $exe->validator->validate($input, $rules))
{
	// do error telling use thingy, for example : 
}
</code></pre>
<p>Sneak peak of what I usually do : </p>
<p>1. Flash the form, so later it will populate the fields with the flashed form_data (also covered later) </p>
<pre><code>
$exe->form->flash();
</code></pre>
<p>2. Create a flash error messages. Basically it flashes all of the error messages.</p>
<pre><code>
$exe->flash->set($errors);
</code></pre>
<p>3. Redirect.</p>
<pre><code>
$exe->redirect->to('user.profile.edit');
</code></pre>