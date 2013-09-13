SlimBlog
========

Flat File Blog made using Slim Framework

Thank you for visiting SlimBlog. It is a simple, easy to use PHP flat-file blog engine built on top of Slim Framework.

To deply simply place it on a webserver in a publicly accessable folder and make sure apache can see the folder.

Files need to be uploaded in markdown format, as the document parser reads markdown.

All articles need to start with a JSON string at the top that provides the document meta-data and associated title etc. 

	{
	   "title" : "This is my first article",
	   "date"  : "02/15/2012",
	   "slug"  : "first-article",
	   "author": "Author name"
	}

See the above example there for how to format the JSON correctly. When you save the article, make sure you save it with the same value you place in the slug field in the JSON.

The application looks for the route http://yourwebsite/slug which is a handler that points to the articles folder.

For example `http://yourwebsite/first-article` will look for `articles/first-article.txt` and then attempt to parse it.


If you are interested in more of my work, head over to my made repository list available on GitHub at [my github profile](http://davidsivocha.github.io) or at my my personal site [Sivocha](http://sivocha.com).
