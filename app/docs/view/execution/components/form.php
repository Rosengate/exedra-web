<h1>Form <span>\Exedra\Application\Utilities\Form</span></h1>
<p>A utility class that help you write a form's input elements. This class is accessible through the $exe instance</p>
<p>Let say we're passing the $form instance that was taken from the $exe instance to the view.</p>
<pre><code>
$data['form'] = $exe->form;
$view->set($data)->render();
</code></pre>
<h2>1. text, password, hidden, textarea, time or date</h2>
<pre><code>
// write &lt;input type='text' name='username' id='username' /&gt;
echo $form->text('username');

// write type of password, hidden textarea
echo $form->password('password');
echo $form->hidden('apiKey');
echo $form->textarea('description');
echo $form->date('birthDate');
echo $form->time('birthTime');
</code></pre>
<h3>1.1 Specifiying attribute</h3>
<pre><code>
// by string
echo $form->text('username', 'class="form-control"');

// by array
echo $form->password('password', ['class'=>'form-control']);
</code></pre>
<h3>1.2 Set value</h3>
<p>For text, password, hidden or textarea input type. You may set value as 3rd argument.</p>
<pre><code>
echo $form->text('username', null, 'lucy');
</code></pre>
<h2>2. Select</h2>
<p>You'll need an associated array containing value=>label for this select element</p>
<pre><code>
$countries = array[
	'my'=>'malaysia',
	'ph'=>'philippine',
	'sg'=> 'singapore',
	'id'=> 'indonesia'];

echo $form->select('seaCountry', $countries, 'class="form-control"');
/* will print 
&lt;select class="form-control" name="seaContry" id="seaContry" &gt;
	&lt;option&gt;malaysia&lt;/option&gt;
	&lt;option&gt;philipphine&lt;/option&gt;
	&lt;option&gt;singapore&lt;/option&gt;
	&lt;option&gt;indonesia&lt;/option&gt;
&lt;/select&gt;
*/

</code></pre>
<h3>2.1 Set value</h3>
<p>For select, you may pass value as 4th argument.</p>
<pre><code>
echo $form->select('seaCountry', $countries, null, 'my');
</code></pre>
<h2>3. Pre-populating form</h2>
<p>You may populate the form's inputs with your data before they are even printed</p>
<p>Pass the array of data containing keys (name of the input) against the values</p>
<pre><code>
$exe->form->set([
	'username'=>'adam',
	'email'=>'adam1022@gmail.com',
	'age'=>10
	]);
</code></pre>
<p>Or per key</p>
<pre><code>
$exe->form->set('website', 'http://facebook.com/adam');
</code></pre>
<h2>4. Flash</h2>
<p>A utility method to flash the inputs with existing _POST data (on default), that it would populate all the inputs with them, on the next request.</p>
<pre><code>
if($exe->request->post)
{
	$exe->form->flash();
	return $exe->redirect->refresh();
}
</code></pre>
<p>Basically it does what below code is doing :</p>
<pre><code>
$exe->flash->set('form_data', $this->exe->request->post);
</code></pre>
<h3>4.1 Retrieving flashed form data</h3>
<p><u>Just in case</u> if you want to retrieve the flashed data, you may do this way :</p>
<pre><code>
$username = $exe->flash->get('form_data.username');
</code></pre>
<p>p/s : hence, key <b>form_data</b> is a reserved one for this usage.</p>