<?php
	$url = base64_decode($_GET['url']);
   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);

	$posBeg = strpos($ret, 'SelectHdate">') + 13;
	$posEnd = strpos($ret, '</div>', $posBeg);
	$date = substr($ret, $posBeg, $posEnd - $posBeg);
	$date = str_replace('年', '-', $date);
	$date = str_replace('月', '-', $date);
	$date = str_replace('日', 'T00:00:01+00:00', $date);

	$posBeg = strpos($ret, 'photo intro_photo');
	$posBeg = strpos($ret, 'src="', $posBeg) + 5;
	$posEnd = strpos($ret, '"', $posBeg);
	$pic = substr($ret, $posBeg, $posEnd - $posBeg);

	/*$posBeg = strpos($ret, '<a href="/author');
	$posBeg = strpos($ret, '>', $posBeg) + 1;
	$posEnd = strpos($ret, '</a>', $posBeg);*/
	$posBeg = strpos($ret, 'og:title" content=\'') + 19;
	$posBeg = strpos($ret, '（', $posBeg);
	$posEnd = strpos($ret, '）', $posBeg);
	$author = substr($ret, $posBeg, $posEnd - $posBeg);
	$author = str_replace('（', '', $author);

	$posBeg = strpos($ret, 'og:title" content=\'') + 19;
	$posEnd = strpos($ret, '\'', $posBeg);
	$title = substr($ret, $posBeg, $posEnd - $posBeg);
	$posBeg = strpos($title, '（');
	$title = substr($title, 0, $posBeg);

	$posBeg = strpos($ret, '<p>');
	$posEnd = strpos($ret, '</p>', $posBeg) + 4;
	$content = substr($ret, $posBeg, $posEnd - $posBeg);
	$content = str_replace('<br />', '<br/>', $content);
	$posBeg = strpos($content, '<br/><br/>');
	$content = substr($content, 0, $posBeg);
	$content = str_replace('<br/><br/>', '<br/>', $content);
	$content = str_replace('<br/>', '<br/><br/>', $content);
	$content = str_replace('http://www.facebook.com/mrleeyee', '', $content);
	
	/*$contentNew = '<!DOCTYPE html>
			<html lang="zh-TW">
			<head>
			<meta charset="UTF-8">
			<title>'.$title.'</title>
			<meta property="og:image" content='.$pic.'" />
			</head>
			<body><p>'.$content.'</p></body>
			</html>
			';*/

	$contentNew = '
	<!DOCTYPE HTML>
<html>
<head>
    <!--Setting-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no,email=no,adress=no">
    <meta name="browsermode" content="application">
    <meta name="screen-orientation" content="portrait">
    <link rel="dns-prefetch" href="http://yoursite.com">
    <!--SEO-->



<meta name="robots" content="all" />
<meta name="google" content="all" />
<meta name="googlebot" content="all" />
<meta name="verify" content="all" />
    <!--Title-->


<title>生活在孤独中前行 | Ryan&#39;s Blog</title>


    <link rel="alternate" href="/atom.xml" title="Ryan&#39;s Blog" type="application/atom+xml">


    <link rel="icon" href="/header.ico">

    



<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css?rev=3.3.4">
<link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/style.css?rev=@@hash">




    



    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?6c28d86dfc1693141c08f16653ea588c";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>



    
</head>


<!--[if lte IE 8]>
<style>
    html{ font-size: 1em }
</style>
<![endif]-->
<!--[if lte IE 9]>
<div style="ie">你使用的浏览器版本过低，为了你更好的阅读体验，请更新浏览器的版本或者使用其他现代浏览器，比如Chrome、Firefox、Safari等。</div>
<![endif]-->

<body>
    <header class="main-header"  style="background-image:url(http://onq81n53u.bkt.clouddn.com/neweeess_%E5%89%AF%E6%9C%AC.png)"  >
    <div class="main-header-box">
        <!--
		<a class="header-avatar" href="/" title="">
            <img src="/img/avatar.jpg" alt="logo头像">
        </a>
		-->
        <div class="branding">
        	<!--<h2 class="text-hide">Snippet主题,从未如此简单有趣</h2>-->
            
                 <img src="/img/branding.png" alt="Snippet 博客主题">  
             
    	</div>
    </div>
</header>
    <nav class="main-navigation">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="navbar-header"><span class="nav-toggle-button collapsed" data-toggle="collapse" data-target="#main-menu" id="mnav">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-bars"></i>
                    </span>
                </div>
                <div class="collapse navbar-collapse" id="main-menu">
                    <ul class="menu">
                        
                            <li role="presentation"><a href="/"><i class="fa fa-fw "></i>首页</a>
                            </li>
                        
                            <li role="presentation"><a href="/categories/学习/"><i class="fa fa-fw "></i>学习</a>
                            </li>
                        
                            <li role="presentation"><a href="/categories/生活/"><i class="fa fa-fw "></i>生活</a>
                            </li>
                        
                            <li role="presentation"><a href="/categories/关于/"><i class="fa fa-fw "></i>关于</a>
                            </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
    <section class="content-wrap">
        <div class="container">
            <div class="row">
                <main class="col-md-8 main-content m-post">
                    <p id="process"></p>
<article class="post">
    <div class="post-head">
        <h1 id="生活在孤独中前行">
            
	            生活在孤独中前行
            
        </h1>
        <div class="post-meta">
    
    
    <span class="categories-meta fa-wrap">
        <i class="fa fa-folder-open-o"></i>
        <span>生活</span>
    </span>
    
    
    <span class="fa-wrap">
        <i class="fa fa-tags"></i>
        <span class="tags-meta">
            
            鸡汤
            
        </span>
    </span>
    
    
    <span class="fa-wrap">
        <i class="fa fa-clock-o"></i>
        <span class="date-meta">2018/01/05</span>
    </span>
</div>

            
            
    </div>
    
    <div class="post-body post-content">
        <p><img src="http://onq81n53u.bkt.clouddn.com/timsdfeeg.jpg" alt=""></p>
<p>Tips：一边听下面的音频一边看会更有感觉！主播叫做NJ瓜瓜。</p>
<iframe frameborder="yes" border="0" marginwidth="0" marginheight="0" width="300" height="65" src="http://onq81n53u.bkt.clouddn.com/%E7%94%9F%E6%B4%BB%E5%9C%A8%E5%AD%A4%E7%8B%AC%E4%B8%AD%E5%89%8D%E8%A1%8C.mp3"><br></iframe>  

<blockquote>
<p>生活不可能像你想象得那么好，但也不会像你想象得那么糟。我觉得人的脆弱和坚强都超乎自己的想象。有时，我可能脆弱得一句话就泪流满面，有时，也发现自己咬着牙走了很长的路。——莫泊桑</p>
</blockquote>
<p>以这一句话开始，是因为看了高木直子的《一个人住第五年》。都说人是慢慢成长的，其实不是，人是瞬间长大的，就像是突然间沉淀一般，突然不会谈恋爱了或者说不想谈恋爱了，一个人生活单一却也不会觉得无聊，即便很多时候还是会迷茫却也不会觉得烦躁了。去年的今天我在不一样的城市，背着不一样的书包，留着不一样的发型，走着不一样的路，想着不一样的事情，有着不一样的心思，谁说改变要十年呢。或者说，这一秒的想法和上一秒的想法就不一样，这个世界是瞬间变化的，运转速度是那么快，没有人在意你是不是一个人。而我呢，就是一个人，默默地在做自己的事，感受着生活中的变化，也感受着自己的变化，在不断的变化中，寻找最佳的结合点和平衡点。信奉一句话：变化中求生存。专注和节奏是生活的主旋律。</p>
<p>身边的牛人倒是不少，像是神抵一样的存在，我也只是羡慕想着反正自己也不会变成那样的人，直到有一天跟国内比较有影响力28岁的年轻总裁聊天，才知道原来他也有看不进去书，经常想方案想到撞墙的时候，我们都忘了他们是用怎么样的一个代价才换取来了这样的一个人生。他说，如果你想要去实现梦想，孤独是你的必修课。如果不能沉下心来，就没有办法去实现它，因为那绝对不是一件容易的事情，孤独能让你更坚强，你必须找到自己的生活节奏。</p>
<p>最近迷上一个人到处走，算不上旅行只是周围到处走一走，倒也不会花上太多时间准备，起身就走了。我不会带上相机只是有兴致了拿出手机拍一拍，音乐倒是我走到哪里都不能丢的东西，每个月都会去听几场音乐会，只有音乐，能让看似漫长的等待变成曼妙的旅程，似乎自己跟整个世界都没有关系，只想当一片没有名字的云，徜徉在不知道名字的风景里。<br>我们都会找到自己的生活节奏，然后沉溺其中无法自拔。</p>
<p>曾经学生时代很少去图书馆，觉得那种“每个星期读一本书”对于我来讲有点勉强。但之后的某一天我陪朋友去图书馆，他是一个借书就不会停的人，我也就跟着借了几本。回到家里看微博人人又觉得心里空当当的，索性就拿起书来看，也是在那一天我才发现，其实每个星期看一本书没那么难，那天我一下子把书看完，才觉得这样子的生活是充实的。所以我喜欢读书，读很多书，尽管现在时间很紧，有时候忙得让自己无法开胶，但每天还是会抽出一点时间来，看看书。</p>
<p>要么读书，要么旅行，身体和灵魂，必须有一个在路上。</p>
<p>我告诉自己现实容不得你拖延，拖延只会让我变得更焦虑而已，所以刚开始的时候我规定自己每天提早上床半小时，看上几十页书，很快就变成习惯了。有的时候我不得不感叹如果真的去做一件事情的话，那么这件事情没有那么难。当你真的想要做一件事情的时候，整个世界都会来协助你，就是这种感觉。想起了09年艺考备战时，想起了面试节目时，经常告诉自己的一句话：当你只有一个目标时，全世界都会为你让路。</p>
<p>一个喜欢冒险和旅游的朋友说，只要出发，就能到达，你不出发，就哪里也去不了。如果你不能沉下心来，就什么也做不到。出发永远是最有意义的事，去做就是了。一本书买了不看只是几张纸，公开课下了不看也只是一堆数据，不去看就没有任何意义，反而徒增焦虑，行动力才是最关键的。</p>
<p>你也许也是这样，当你渴望找个人交谈的时候，你们却没有谈什么，于是发现有些事情是不能告诉别人的，有些事情是不必告诉别人的，有些事情是根本没有办法告诉别人的，而有些事情即使告诉了别人，你也会马上后悔，那么最好的办法就是静下来，真正能平静自己的只有自己。</p>
<p>没有人能免得了孤独，与其逃避它不如面对它。孤独并不是一件那么糟糕的事情，与嘈杂相比，一个人生活倒显得自得地多，倒也可以变成一种享受。或许至少需要那么一段时间，几年或几个月，一个人生活，不然怎么能找到自己的节奏知道自己想要什么。这是属于你自己的东西，是你的一部分，你听音乐时，坐地铁时，一个人走在马路上时，它就会流淌出来，让我觉得这个世界似乎在以另外一种形式存在着，我能够清晰地听到自己，不断地在和自己对话交流。所以，我很喜欢独处，喜欢一个人漫无目的的随便走走。</p>
<p>我们都生活在一个不那么如意的世界，当乌云密布我们就摇曳，但阳光总有一天会到来，等阳光照到你的时候，记得开出自己的花就行了，那个你与生俱来的梦想。有的时候梦想很远，有的时候梦想很近，但它总会实现的。我想一个人最好的样子就是平静一点，哪怕一个人生活，穿越一个又一个城市，走过一个又一条街道，仰望一片又一片天空，见证一次又一次别离。</p>
<p>即便世界与我为敌，只要心还透明，就能折射希望。</p>
<p>接下来说说“选择”，选择，是一门艺术，一种技巧，一种生活的情调。什么都有正反两面，有些是我们能把握控制的，有些是我们不能左右的，但是我们有选择的权利，可以选择我们自己的生活。小处说，可以选择一种心情，一件衣服，甚至中午我们要吃什么饭，大处讲，我们可以选择一段感情，一种方式，一种习惯，一种性格，一种态度，一种人生。而这一切的出发点都是我们的内心，依据内心和环境而做出的选择。选择的任何一种形式都要为我们的结果服务的，不然选择就毫无意义，通常我们会采用两种方式思考问题和做出选择：基于自己的真实想法和基于事情的后果。但是都要归到一个点上，你要为你的选择买单。</p>
<p>如果你感觉你会后悔，那么你就不要去选择；如果你选择了，你就永远不要后悔。</p>
<p>然后就是“比较”比较，是一门哲学。比较就像一面镜子，可以知得失，知利弊，知不足，知缺点也知优点。比较是自己的一部历史，给你经验，给你教训，让你更加了解你自己，进而完善自己。在和周围的比较时，别忘了和昨天的你做比较，这样会进步更快。</p>
<p>“变化”，上边已经提到一点，变化其实才是生活的实质，人是在变化的，生活是在变化的，社会是在变化的，整个世界也在不断的变化，而你要不要变化？？？要不要去适应这个世界，赶上节奏？？？当你一种不好的习惯或者性格，把你的而生活搞得很糟糕时，你还在怂恿它，不想改变，为什么？？你已经很清洗地认识到它的弊端了，为什么不变？？当它直到有一天，事情搞到无法挽救的地步，你才想起要改变，是不是有点晚了。人的惰性和致命弱点。这或许我们每个人都经历过，才会一步一步长大成熟。穷则思变，穷则生变，有变才有进步。变，是一种考验和磨练，让你坚强，让你自信，让你成熟。</p>
<p>一个人的思想和认识的变化对他来说，很重要。只有思想上的变革才会有行为上的变化。其实也就是我们所说的想与做的问题，但是一般人所说的想，只是随便的想一想，并没有深入到根本本质的东西，没有认真的分析，要做成一件事，需要什么样的思想、认识，需要什么环境、条件，还有需要自身什么精神或者品质、习惯（如坚持、吃苦、坚强、勤奋、激情等等）这可以说也是一个逻辑思维的过程，但却是做成一件事必不可缺少的过程。想起来电视上狄仁杰说过的一句话：想做成一件事要有三断——判断、推断、果断。也如现在人们所说的三力——判断力、分析力、执行力，所以什么事都不是那么简简单单容易的就做成的，需要你做的很多。</p>
<p>对于“简单”来说，不同的人有不同的认识，一千个读者一千个哈姆雷特。真正的大家、智者、老者所认为的简单，其实是不简单。简单是从复杂中提炼出来的，没有经过复杂哪里来的简单。与其说简单是一种幸福，不如说经历复杂是一种幸福。路遥《平凡世界》上有一句关于幸福的解释，值得借鉴：幸福不只是吃饱穿暖，而是勇敢地去战胜困难，一点一点地不断超越自己！</p>
<p>“平衡”我对平衡感要求很高的，这种思想是我从生态学上学到的，我认为生态学中有一种思想就是平衡和和谐。任何一个环境，包括我们人类所生活的社会环境，都需要在一个平衡和谐的状态下才能持久下去，不然都会被淘汰的，针对一个人个体上说也是一样的，你如果不能保持你内心的一种平衡，你肯定会抱怨的，每个人都一样，都会这样的。那我们该怎样做，才能是我们的身与心、内与外的平衡和谐呢。这是我们要找的东西，因人而异，要量体裁衣。</p>
<p>那么孤独是人生的一部分，缺少了孤独，似乎人生也就不完美了，所以我们应该习惯孤独，爱上孤独，它能告诉你很多人生的秘密。相信我。</p>

    </div>

    <div class="post-footer">   
        <div>
            
                转载声明：商业转载请联系作者获得授权,非商业转载请注明出处 © <a href="" target="_blank">RyanLee</a>
            
        </div>
        <div>
            
        </div>  
    </div>
</article>

<div class="article-nav prev-next-wrap clearfix">
    
        <a href="/2018/01/09/Hexo你所不知道的奇淫巧技【持续更新】/" class="pre-post btn btn-default"><i class="fa fa-angle-left fa-fw"></i>上一篇</a>
    
    
        <a href="/2017/12/15/用RecyclerView做一个小清新的Gallery效果/" class="next-post btn btn-default">下一篇<i class="fa fa-angle-right fa-fw"></i></a>
    
</div>
                </main>
                
    <aside class="col-md-4 sidebar">
        
        
    <div class="widget">    
        <h3 class="title">Search</h3>
        <div id="search-form">
            <div id="result-mask" class="hide"></div>
            <div class="search-area">
                
                    <input id="search-key" type="search" autocomplete="off" placeholder="搜点什么呢?">
                    <button type="button" class="search-form-submit" id="search-local">localSearch</button>
                
                
            </div>
            <div id="result-wrap" class="hide">
                <div id="search-result"></div>
            </div>
            <div class="hide">
                <template id="search-tpl">
                    <div class="item">
                        <a href="/{path}" title="{title}">
                            <div class="title">{title}</div>
                            <div class="content">{content}</div>
                        </a>
                    </div>
                </template>
            </div>
        </div>
    </div>

        
        
    <div class="widget notification">
        <h3 class="title">网站公告</h3>
        <div>
            <p>有需要可以关注我<a href="https://github.com/ryanlijianchang"  target="_blank">Github</a>提Issue哈，
<br/>如果Github找不到可以联系邮箱：liji.anchang@163.com，
<br/>但是我希望你能够自己认真地思考完再找我哈~
</p>
        </div>
    </div>

        
        
    <div class="widget">
      <h3 class="title">Social</h3> 
        <div class="content social">
            
	            <a href="https://github.com/ryanlijianchang" rel="external nofollow" title="Github" target="_blank">
			    	<i class="git fa fa-git"></i>
			    </a>
            
	            <a href="mailto:liji.anchang@163.com" rel="external nofollow" title="邮箱" target="_blank">
			    	<i class="envelope-o fa fa-envelope-o"></i>
			    </a>
            
	            <a href="https://weibo.com/ryan2lee" rel="external nofollow" title="微博" target="_blank">
			    	<i class="weibo fa fa-weibo"></i>
			    </a>
            
	            <a href="/atom.xml" rel="external nofollow" title="RSS" target="_blank">
			    	<i class="feed fa fa-feed"></i>
			    </a>
            
        </div>
    </div>


        
        
    <div class="widget">
        <h3 class="title">Categories</h3>
        <ul class="category-list"><li class="category-list-item"><a class="category-list-link" href="/categories/学习/"><i class="fa" aria-hidden="true">学习</i></a><span class="category-list-count">10</span></li><li class="category-list-item"><a class="category-list-link" href="/categories/生活/"><i class="fa" aria-hidden="true">生活</i></a><span class="category-list-count">1</span></li></ul>
    </div>


        
        
    <div class="widget">
      <h3 class="title">Archives</h3>
        <ul class="archive-list"><li class="archive-list-item"><a class="archive-list-link" href="/archives/2018/01/"><i class="fa" aria-hidden="true">January 2018</i></a><span class="archive-list-count">3</span></li><li class="archive-list-item"><a class="archive-list-link" href="/archives/2017/12/"><i class="fa" aria-hidden="true">December 2017</i></a><span class="archive-list-count">1</span></li><li class="archive-list-item"><a class="archive-list-link" href="/archives/2017/08/"><i class="fa" aria-hidden="true">August 2017</i></a><span class="archive-list-count">1</span></li><li class="archive-list-item"><a class="archive-list-link" href="/archives/2017/07/"><i class="fa" aria-hidden="true">July 2017</i></a><span class="archive-list-count">1</span></li><li class="archive-list-item"><a class="archive-list-link" href="/archives/2017/04/"><i class="fa" aria-hidden="true">April 2017</i></a><span class="archive-list-count">3</span></li><li class="archive-list-item"><a class="archive-list-link" href="/archives/2017/03/"><i class="fa" aria-hidden="true">March 2017</i></a><span class="archive-list-count">2</span></li></ul>
    </div>


        
        
  <div class="widget">
    <h3 class="title">Tag Cloud</h3>
    <div class="content tag-cloud">
        <a href="/tags/Fragment优化/" style="font-size: 10px;">Fragment优化</a> <a href="/tags/Hexo/" style="font-size: 10px;">Hexo</a> <a href="/tags/RecyclerView/" style="font-size: 10px;">RecyclerView</a> <a href="/tags/动画/" style="font-size: 20px;">动画</a> <a href="/tags/图片轮播/" style="font-size: 10px;">图片轮播</a> <a href="/tags/奇淫巧计/" style="font-size: 10px;">奇淫巧计</a> <a href="/tags/鸡汤/" style="font-size: 10px;">鸡汤</a>
    </div>
  </div>


        
        
    <div class="widget">
        <h3 class="title">Friends</h3>
        <div class="content friends-link">
        
            <a href="http://blog.csdn.net/ljcitworld" class="fa" target="_blank">CSDN博客</a>
        
            <a href="f" class="fa" target="_blank">49</a>
        
        </div>
    </div>


        
    </aside>

            </div>
        </div>
    </section>
    <footer class="main-footer">
    <div class="container">
        <div class="row">
        </div>
    </div>
</footer>

<a id="back-to-top" class="hide">
	<i class="fa fa-chevron-up"></i>
</a>




    <div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-sm-12"> 
                <span>Copyright &copy; 2017
                </span> | 
                <span>
                    Powered by <a href="//hexo.io" class="copyright-links" target="_blank" rel="nofollow">Hexo</a>
                </span> | 
                <span>
                    Theme by <a href="//github.com/shenliyang/hexo-theme-snippet.git" class="copyright-links" target="_blank" rel="nofollow">Snippet</a>
                </span>
            </div>
        </div>
    </div>
</div>



	<script src="/js/search.js?rev=@@hash"></script>


<script src="/js/app.js?rev=@@hash"></script>


</body>
</html>
			';
		
	echo $contentNew;
?>
