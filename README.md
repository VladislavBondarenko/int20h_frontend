<h1>News website - implemented service of recommendations</h1>
<h5>By rm-rf team</h5>
<p>Authorization is performed using VK API for vk.com.</p>
<p>The service sorts news according to the user interests. In the case of unauthorized use of the chronological order. 
News are divided into categories. Each category has its own keywords. 
The program searches for the matches of each word with the words in the group names to which the user is subscribed. 
In case of coincidence, points are assigned to a certain category.</p>
<p>Also records of all views of authorized users are stored in the database. 
If certain news was viewed by your friends, they are also awarded points.</p>
<p>The more points the category picks up, the more likely it is that its news will be shown first.</p>
<p>You can see Back-end server at https://github.com/VladislavBondarenko/int20h_backend.</p>

