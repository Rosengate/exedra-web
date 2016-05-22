<h1>About Exedra</h1>
<p>A nestable route-oriented PHP Micro-framework, capable of letting you design the map and routes of your application hierarchically, while being flexible and contextual at the sametime, without much interfering with how your application is supposed to work.</p>
<p>As a microframework, there aren't much services/components you can expect. It's an alternative to anyone who seeks much minimal design yet expandable, a container based microframework, although there might be some steep learning, considering that it didn't meant to be much pragmatic, but explicit.</p>
<h2>Why ?</h2>
<p>URI oriented routing; one of the most wonderful component in modern web development, or specifically a web service development. There're already tons of framework/microframework doing this, but couldn't find the exact one that does a nestful routing hierarchically.</p>
<p>Imagine about having list of APIs, most of them repetitively written in a nearly similar pattern.</p>
<pre><code>
GET /api/users
POST /api/users
GET /api/users/:id
POST /api/users/:id
GET /api/users/:id/settings
POST /api/users/:id/settings
GET /api/users/:id/settings/:key
POST /api/users/:id/settings/:key
</code></pre>
<p>Imagine growing this list to 5-10 times larger and maintaining them all.</p>
<p>The idea is, how about maintaining those lists hierarchically. Imagine about every segment of URI path, as a node. A node you can expand, validate, authenticate, maintain, without worrying about other places.</p>
<h3>How about performance</h3>
<p>The routing map isn't wholly constructed unless traversed. A route along with the group/subroutes beneath it will not be traversed, if the initial path segment didn't match.</p>