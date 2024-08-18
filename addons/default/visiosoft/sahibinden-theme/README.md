# sahibinden theme

###How to create HomePage Banner?

##1 - Create Repeater Fields (Repeater Module)

       - image = [
             type = file field type,
             name = image,
             folder = images,
            ],
       - url = [
             type = url field type,
             name = URL
            ],


##2 - Create Repeater (Repeater Module)

       Banner Repeater = [
           name = Banner Repeater,
           assigments fields = [image,url],
       ],


##3 - Create Block Field (Blocks Module)

        Banner Repeater = [
            name = Banner Repeater,
            type = repeater field type,
            repater = Banner Repeater
        ],

##4 - Create Block Type (Blocks Module)

        Banner Type = [
            name = Banner Type,
            category = other,
            content = {% for banner in block.banner_repeater %}
                      	<a href="{{ banner.url.value }}">
                      		<img class="w-100 mb-2" src="{{ banner.image.url }}" alt="{{ block.slug }}">
                      	</a>
                      {% endfor %}
                      
            assignments = [Banner Repeater]
        ],



###How to create Banner Block For Homepage Left Space?

##1 - Create Block Area (Blocks Module)

        Homepage Left Banner = [
            name = Homepage Left Banner
            block = [Banner Type]
        ],



##2 - Create Block (Blocks Module)

        Homepage Left Banner = [
            add block = [Banner Type]
        ],


###How to create Banner Block For Homepage Right Space?

##1 - Create Block Area (Blocks Module)

        Homepage Right Banner = [
            name = Homepage Right Banner
            block = [Banner Type]
        ],



##2 - Create Block (Blocks Module)

        Homepage Right Banner = [
            add block = [Banner Type]
        ],

See the **[documentation](https://docs.openclassify.com/)** for more information.
