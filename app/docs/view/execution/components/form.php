<h1>Form <span>\Exedra\Application\Utilities\Form</span></h1>
<p>A utility class that help you write a form's input elements. This class is accessible through the $exe instance</p>
<p>Let say we're passing the $form instance that was taken from the $exe instance to the view.</p>
<pre><code>
$view->set('form', $exe->form)->render();
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
<h3>1.1 Set value and attributes</h3>
<pre><code>
echo $form->text('username', 'luckylucy777', 'class="form-control"');
</code></pre>
<h5>Chained</h5>
<pre><code>
echo $form->textarea('about')
		->value('a silver haired lady')
		->attr(['placeholder' => 'Your secret all about']);
</code></pre>
<h5>Overwrite id</h5>
<pre><code>
echo $form->password('password')->id('form-password');
</code></pre>
<h2>2. Select</h2>
<p>You'll need an associated array containing key value pairs for this select element</p>
<pre><code>
$countries = array[
	'my'=>'malaysia',
	'ph'=>'philippine',
	'sg'=> 'singapore',
	'id'=> 'indonesia'];

echo $form->select('seaCountry', $countries, 'class="form-control"');
</code></pre>
<h5>Chained</h5>
<pre><code>
echo $form->select('seaCountry')->options($countries)->attr('class="form-control"');
</code></pre>
<p>Both example will print something similar like :</p>
<pre><code>
&lt;select class="form-control" name="seaContry" id="seaContry" &gt;
	&lt;option value="my" &gt;malaysia&lt;/option&gt;
	&lt;option value="ph" &gt;philipphine&lt;/option&gt;
	&lt;option value="sg" &gt;singapore&lt;/option&gt;
	&lt;option value="id" &gt;indonesia&lt;/option&gt;
&lt;/select&gt;
</code></pre>
<h3>2.1 Optgroup</h3>
<pre><code>
echo $form->select('food', array(
	'Arabian' => array(
		'shawarma' => 'Shawarma',
		'arabianrice' => 'Arabian Rice',
		'lamb' => 'Lamb'
		),
	'Asian' => array(
		'nasilemak' => 'Nasi Lemak',
		'tomyam' => 'Tom yam'
		)
	));
</code></pre>
<p>Will print something similar like :</p>
<pre><code>
&lt;select class="form-control" name="food" id="food" &gt;
	&lt;optgroup label="Arabian"&gt;
		&lt;option value="shawarma" &gt;Shawarma&lt;/option&gt;
		&lt;option value="arabianrice" &gt;Arabian Rice&lt;/option&gt;
		&lt;option value="lamb" &gt;Lamb&lt;/option&gt;
	&lt;/optgroup&gt;
	&lt;optgroup label="Asian"&gt;
		&lt;option value="nasilemak" &gt;Nasi Lemak&lt;/option&gt;
		&lt;option value="tomyam" &gt;Tom Yam&lt;/option&gt;
	&lt;/optgroup&gt;
&lt;/select&gt;

</code></pre>
<h3>2.1 Set value</h3>
<p>For select, you may pass value as third argument.</p>
<pre><code>
echo $form->select('seaCountry', $countries, 'my');
</code></pre>
<p>Or chained if you like</p>
<pre><code>
echo $form->select('country', $countries)->value('my');
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
<p>Populate list based input</p>
<pre><code>
$exe->form->setOptions('countries', array(
	'my'=>'malaysia',
	'ph'=>'philippine',
	'sg'=> 'singapore',
	'id'=> 'indonesia'));
</code></pre>
<h2>4. Flash</h2>
<p>A utility method to flash the inputs with existing _POST data (on default), that it would populate all the inputs with them, on the next request.</p>
<pre><code>
if($exe->request->isMethod('post'))
{
	$exe->form->flash();
	return $exe->redirect->refresh();
}
</code></pre>
<p>The <span class='label label-variable'>$exe->form->flash()</span> basically does what below code is doing :</p>
<pre><code>
$exe->flash->set('form_data', $this->exe->request->post());
</code></pre>
<h3>4.1 Retrieving flashed form data</h3>
<p><u>Just in case</u> if you want to retrieve the flashed form data from flash instance directly, you may do this way :</p>
<pre><code>
$username = $exe->flash->get('form_data.username');
</code></pre>
<p>p/s : hence, key <b>form_data</b> is a reserved one for this usage.</p>