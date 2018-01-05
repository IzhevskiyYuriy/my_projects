
$(document).ready(function () {
    if ("undefined" !== typeof FormSerializer) {
        $.extend(FormSerializer.patterns, {
            validate: /^[a-z_][a-z0-9_:-]*(?:\[(?:\d*|[a-z0-9_:-]+)\])*$/i,
            key:      /[a-z0-9_:-]+|(?=\[\])/gi,
            named:    /^[a-z0-9_:-]+$/i
        });
    }

    var $selectBlockTemplate = $('.select-block-template');
    $selectBlockTemplate.on('change', BlockTemplate.fillSelectedSizes);

    if (!$selectBlockTemplate.hasClass('do-not-fill-default-by-js')) {
        // for filling amounts
        $selectBlockTemplate.trigger('change');
    }


    $(".open-block-code").on('click', BlockTemplate.showIncludeCode);

    if ($("#teaser-config").length > 0) {
        $("#teaser-id").on("change", function (e) {
            var teaserId = $(this).val();
            $("#post-id").val(relinks[teaserId]);
        });
    }

    (new BlockTemplate()).initialize();
});

function Block(data) {
    var keys = Object.keys(data);

    for (var i in keys) {
        var key = keys[i];
        this[key] = data[key];
    }
}

Block.load = function (blockId, callback) {
    $.get('/blocks/view/' + blockId, function (response) {
        callback(new Block(response.block));
    }, "json");
}

function BlockTemplate() {
    this.$container = $("#block-config");
    var self = this;

    this.initColorPicker = function() {
        var $inputs = this.$container.find('.colorpick-container');
        $inputs.each(function (i, elem) {
            $(elem).find('.colorpick-input').minicolors({
                animationSpeed: 150,
                position: 'bottom right'
            });
        }, this);
    }

    this.initialize = function () {
        this.initColorPicker();
        this.render();

        $("form#block-config input, form#block-config select").on("change", function () {
            self.render();
        });
    }

    this.render = function () {
        var cssGenerator = new BlockTemplate.css();
        if (cssGenerator.created) {
            cssGenerator
                .genMain()
                .genForLink()
                .genForTeaser()
                .genForTeaserImage()
                .genForTeaserText();


            var table = new BlockTemplate.table(cssGenerator.className, cssGenerator.params.amount_y, cssGenerator.params.amount_x);
            table.gen(cssGenerator);
        }
    }
}

BlockTemplate.css = function () {
    this.created = false;
    if ("function" !== typeof $.fn.serializeObject) return;

    this.className = "block-teasers-BLOCK-ID";
    this.style = '';

    var sObj = $("form#block-config").serializeObject();
    this.params = sObj.blocks_style;
    addNonObjPropsToObj(sObj, this.params);

    this.created = true;
}
BlockTemplate.css.prototype.genMain = function () {
    var block = this.params.block;

    this.style += this._genBlock(null, block, {
            width: this.params.width + this.params.width_units,
            "border-spacing": block.teaser_padding_x + "px " + block.teaser_padding_y + "px",
            "border-collapse": "separate",
            "border-width": block["border-width"] + "px"
        },
        ["background-color", "border-style", "border-width", "border-color"]
    );

    this.style += this._genBlock(' a', {}, {
            "text-decoration": "none",
            display: "block"
        }
    );

    this.style += this._genBlock(':hover', block[":hover"], {}, ["background-color"]);

    this.style += this._genBlock(' div', {}, {
            padding: 0,
            border: "none",
            background: "none"
        }
    );

    return this;
};
BlockTemplate.css.prototype.genForLink = function () {
    var link = this.params.link;

    this.style += this._genBlock(" td .block-title .block-link", link, {
            display: "block",
            background: "none",
            "font-size": link["font-size"] + "px",
            "line-height": link["font-size"] + "px",
            "padding-top": link["padding-top"] + "px"
        },
        ["text-align", "font-family", "font-weight", "font-style", "text-decoration", "color"]
    );

    var linkHover = link[":hover"];

    this.style += this._genBlock(" td .block-title .block-link:hover", linkHover, {
            background: "none",
            "text-align": link["text-align"],
            "font-size": link["font-size"] + "px",
            "line-height": link["font-size"] + "px",
        },
        ["font-family", "font-weight", "font-style", "text-decoration", "color"]
    );

    this.style += this._genBlock(" td:hover .block-title .block-link", linkHover, {
            "text-align": link["text-align"],
            "font-size": link["font-size"] + "px",
            "line-height": link["font-size"] + "px",
        },
        ["font-family", "font-weight", "font-style", "text-decoration", "color"]
    );

    return this;
};
BlockTemplate.css.prototype.genForTeaser = function () {
    var teaser = this.params.teaser;

    this.style += this._genBlock(" td ", teaser, {
            "border-width": teaser["border-width"] + "px",
            "vertical-align": this.params.block.valign,
            "padding": teaser["padding"] + "px"
        },
        ["background-color", "border-style", "border-color"]
    );


    this.style += this._genBlock(" td:hover", teaser[":hover"], {}, ["background-color"]);

    return this;
};
BlockTemplate.css.prototype.genForTeaserImage = function () {
    var teaserImage = this.params.teaser.image;
    var teaserImageHover = teaserImage[":hover"];

    var customImgCss = {
        "width": "auto",
        "min-width": teaserImage.height + "px",
        "height": teaserImage.height + "px",
        "text-align": this.params.block.align
    };

    if (teaserImage.manual.align === 'left' || teaserImage.manual.align === 'right') {
        var side = teaserImage.manual.align === 'left' ? "right" : "left";

        customImgCss.display = "table-cell";
        customImgCss["vertical-align"] = this.params.block.valign;
        customImgCss["margin-" + side] = teaserImage["margin-text"] + "px";

    } else if (teaserImage.manual.align === 'top' || teaserImage.manual.align === 'bottom') {
        var side = teaserImage.manual.align === 'top' ? "bottom" : "top";

        customImgCss.display = "block";
        customImgCss["margin-" + side] = teaserImage["margin-text"] + "px";
    }

    this.style += this._genBlock(" td .block-img", teaserImage, customImgCss);

    this.style += this._genBlock(" td .block-img img", teaserImage, {
            "height": teaserImage.height + "px",
            "width": teaserImage.height + "px",
            "border-width": teaserImage["border-width"] + "px",
            "border-radius": teaserImage["border-radius"] + "px"
        },
        ["border-style", "border-color"]
    );

    // for :hover images
    this.style += this._genBlock(" td .block-img:hover", {}, {
            "height": teaserImageHover.height + "px",
            "width": teaserImageHover.height + "px",
            "min-width": teaserImageHover.height + "px",
        }
    );

    this.style += this._genBlock(" td:hover .block-img", {}, {
            "width": "auto",
            "min-width": teaserImageHover.height + "px",
            "height": teaserImageHover.height + "px",
        }
    );

    this.style += this._genBlock(" td:hover .block-img img", teaserImage, {
            "height": teaserImageHover.height + "px",
            "width": teaserImageHover.height + "px",
            "border-width": teaserImage["border-width"] + "px",
            "border-radius": teaserImageHover["border-radius"] + "px"
        },
        ["border-style", "border-color"]
    );

    this.style += this._genBlock(" .block-wrapper", {}, {
        display: "table",
        width: "100%",
        overflow: "hidden",
        "border-spacing": "0px"
    });

    this.style += this._genBlock(" .block-img img:hover", {}, {
            "height": teaserImageHover.height + "px",
            "width": teaserImageHover.height + "px",
            "border-radius": teaserImageHover["border-radius"] + "px"
        }
    );

    return this;
};
BlockTemplate.css.prototype.genForTeaserText = function () {
    var teaserText = this.params.teaser.text;
    var teaserImage = this.params.teaser.image;
    var teaserTextHover = teaserText[":hover"];

    var customTextCss = {
        "text-align": this.params.block.align,
        "font-size": teaserText["font-size"] + "px",
        "min-width": "100%",
        "line-height": teaserText["line-height"] + "px"
    };


    // rewrite because duplicate of code
    if (teaserImage.manual.align === 'left' || teaserImage.manual.align === 'right') {
        var side = teaserImage.manual.align === 'left' ? "right" : "left";

        customTextCss.display = "table-cell";
        customTextCss["vertical-align"] = this.params.block.valign;
        customTextCss["margin-" + side] = teaserImage["margin-text"] + "px";
        customTextCss["padding-" + teaserImage.manual.align] = teaserImage["margin-text"] + "px";
    } else if (teaserImage.manual.align === 'top' || teaserImage.manual.align === 'bottom') {
        var side = teaserImage.manual.align === 'top' ? "bottom" : "top";

        customTextCss.display = "block";
        customTextCss["margin-" + side] = teaserImage["margin-text"] + "px";
    }


    this.style += this._genBlock(" .block-title", teaserText, customTextCss,
        ["font-family", "font-weight", "font-style", "text-decoration", "color"]
    );

    this.style += this._genBlock(" .block-title:hover", teaserTextHover, {
            "font-size": teaserTextHover["font-size"] + "px",
        },
        ["font-family", "font-weight", "font-style", "text-decoration", "color"]
    );

    this.style += this._genBlock(" td:hover .block-title", teaserTextHover, {
            "font-size": teaserTextHover["font-size"] + "px",
        },
        ["font-family", "font-weight", "font-style", "text-decoration", "color"]
    );

    this.style += this._genBlock(
        [" td .block-title", " td .block-img", " td:hover .block-img", " td .block-img img", " td:hover .block-img img"],
        {},
        {
            "-webkit-transition": "all 0.3s linear",
            "-moz-transition": "all 0.3s linear",
            "-o-transition": "all 0.3s linear",
            transition: "all 0.3s linear"
        }
    );

    if (teaserText.manual["text-align"] === "text_on_teaser") {
        this.style += this._genBlock(null, {}, {
            "text-align": "center"
        });

        this.style += this._genBlock(" .block-wrapper > a", {}, {
            position: "relative",
            display: "inline-block"
        });

        this.style += this._genBlock([" .block-wrapper .block-title", " .block-wrapper .block-title:hover"], teaserImage, {
            position: "absolute",
            left: 0,
            bottom: "10px",
            width: (teaserImage.height - 20) + "px",
            "min-width": (teaserImage.height - 20) + "px",
            display: "inline-block"
        });
    }

    return this;
};

BlockTemplate.css.prototype._genBlock = function(selector, params, add, only) {
    selector = selector === null? '' : selector;
    add = "undefined" === typeof add ? {} : add;
    only = "undefined" === typeof only ? [] : only;

    var data = $.extend({}, params, add);
    var allowedKeys = arrayUnique(Object.keys(add).concat(only));

    var css = '';

    for (var i in allowedKeys) {
        var key = allowedKeys[i];
        css += key + ": " + data[key] + " !important;";
    }

    return this._genSelector(selector) + "{" + css + "}";
}
BlockTemplate.css.prototype._genSelector = function(selectors) {
    if( Object.prototype.toString.call( selectors ) !== '[object Array]' ) {
        selectors = [selectors];
    }

    var selectorsList = [];

    for (var i in selectors) {
        var selector = selectors[i];

        selectorsList.push("." + this.className + selector);
    }

    return selectorsList.join(", ");
}
// TODO: вынести BlockTemplate в отдельный js, который подключать только на страницах блоков
BlockTemplate.table = function (className, rows, cols) {
    this.domain = "#";
    this.container = $("#show_res_block").empty();
    this.wrapperClass = "block-wrapper";
    this.imgWrapperClass = "block-img";
    this.previewImgPath = "/images/img.jpg";
    this.textClass = "block-title";
    this.teaserText = "Название тизера и его описание";
    this.linkClass = "block-link";
    this.linkText = "Читать далее";
    this.cssParams = null;
    var d = window.document;

    this.gen = function (cssGenerator) {
        this.cssParams = cssGenerator.params;
        var style = d.createElement("style");
        style.innerHTML = cssGenerator.style;
        this.container.append(style);

        var table = d.createElement('table');
        var tbody = d.createElement('tbody');

        table.setAttribute('class', className);
        table.appendChild(tbody);
        this.container.append(table);

        this.addRows(tbody, rows, cols);
    }

    this.addRows = function (tbody, rows, cols) {
        for (var i = 0; i < rows; i++) {
            tbody.appendChild(this.genRow(cols));
        }
    }

    this.genRow = function (cols) {
        var row = d.createElement('tr');
        var col = null;
        var align = this.cssParams.teaser.image.manual.align;

        for (var i = 0; i < cols; i++) {
            col = d.createElement('td');

            var divWrapper = d.createElement("div");
            var a = d.createElement("a");
            var imgContainer = d.createElement("div");
            var img = d.createElement("img");
            var textContainer = d.createElement("div");

            divWrapper.setAttribute("class", this.wrapperClass);
            a.setAttribute("href", "#");
            imgContainer.setAttribute("class", this.imgWrapperClass);
            img.setAttribute("src", this.previewImgPath);
            textContainer.setAttribute("class", this.textClass);

            textContainer.textContent = this.teaserText;

            imgContainer.appendChild(img);

            //Изображение
            if (align === 'top' || align === 'left') {

                a.appendChild(imgContainer);
            }

            //Читать далее
            if (this.cssParams.link.show_read_more !== "0") {
                var link = d.createElement("span");
                link.setAttribute("class", this.linkClass);
                link.textContent = this.linkText;

                textContainer.appendChild(link);
            }
            a.appendChild(textContainer);

            //Изображение в низу
            if (align === 'bottom' || align === 'right') {
                a.appendChild(imgContainer);
            }

            divWrapper.appendChild(a);
            col.appendChild(divWrapper);
            row.appendChild(col);
        }

        return row;
    }
}


BlockTemplate.fillSelectedSizes = function (e) {
    var $select = $(this);
    var id = $select.val();

    var template = blockTemplates[id];

    $("#amount-x").val(template.amount_x);
    $("#amount-y").val(template.amount_y);
}

BlockTemplate.showIncludeCode = function (e) {
    e.preventDefault();

    var blockId = $(this).parents('.item-row').data("block-id");

    var $modal = $("#js-code-modal");

    Block.load(blockId, function (block) {
        var code = BlockTemplate._genJSCode(block);
        $modal.find(".modal-body code").text(code);

        $modal.modal('show');
    });

    /*setTimeout(function () {
     console.log(2);
     }, 4500);*/

    console.log(blockId);
}

BlockTemplate._genJSCode = function(params) {
    return '<div id="topisider-' + params.id + '"></div>\n'+
        '<script type="text/javascript">\n\
    var topisider'+params.site_id+' = "undefined" === typeof topisider'+params.site_id+' ? {inited: false, initialLoaded: 0, blocksIds: []} : topisider'+params.site_id+';\n\
    topisider'+params.site_id+'.blocksIds.push('+params.id+');\n\
    topisider'+params.site_id+'["block'+params.id+'"] = {\n\
        id: '+params.id+', \n\
        siteId: '+params.site_id+',\n\
        amountX: '+params.amount_x+',\n\
        amountY: '+params.amount_y+',\n\
        width: '+params.width+',\n\
        widthUnits: "'+params.width_units+'",\n\
        async: true \n\
     };\n\
    (function (w, d, p, o, t) {\n\
        o.send = function () {\n\
            (o.queue = o.queue || []).push(arguments);\n\
        };\n\
        o.offset = p.initialLoaded;\n\
        p.initialLoaded += o.amountX * o.amountY;\n\
        \n\
        var id = "topisider-script";\n\
        if (document.getElementById(id) === null) {\n\
            var s = d.createElement(t);\n\
            if (o.async) s.async = 1;\n\
            s.src = "' + scriptDomain + '/static/rotator.js?site_id='+params.site_id+'";\n\
            s.id = id;\n\
            var i = d.getElementsByTagName(t)[0];\n\
            i.parentNode.insertBefore(s, i);\n\
         }\n\
         \n\
        o.send("pageview");\n\
        if (p.inited) p.initBlocks();\n\
    })(window, document, topisider'+params.site_id+', topisider'+params.site_id+'["block'+params.id+'"], "script");\n\
</script>';
}


function arrayUnique(array) {
    var a = array.concat();
    for(var i=0; i<a.length; ++i) {
        for(var j=i+1; j<a.length; ++j) {
            if(a[i] === a[j])
                a.splice(j--, 1);
        }
    }

    return a;
}

function addNonObjPropsToObj(from, to) {
    var keys = Object.keys(from);

    for (var i in keys) {
        var key = keys[i];

        if ("object" !== typeof from[key]) to[key] = from[key];
    }
}
