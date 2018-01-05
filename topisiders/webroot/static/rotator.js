
(
    // view-source:http://block.s1block.com/rotator/69133.js
    /*
     было бы неплохо со временем с помощью node.js и websockets сделать обновление новостей на сайте через время, без перезагрузки страниц

     думаю пригодятся технологии: ajax, node.js, prototype, TypeScript и React + что-нибудь для стилей
     */

    function (e, n) {
        var me = document.getElementById('topisider-script');
        if (me === null) return;

        var siteId = me.src.match(/\?site_id=([0-9]+)/)[1];
        var container = e['topisider' + siteId];

        if (!container) return;

        container.send = function (block, r, i, c) {
            var a = t(i || {});
            var c = c || function () { };

            block.o('http://topisiders.local/events', {//http://topisiders.local/events
                'blockId': block.id,
                'send_type': r,
                'params': a,
                'referrer': n.referrer.substr(0, 1000)
            }, c)
        };

        // if (!e.venus69133 || !e.venus69133.blockId) { return }


        container.initBlocks = function () {
            this.inited = true;

            for (var i in container.blocksIds) {
                var id = container.blocksIds[i];
                var blockName = "block" + id;

                if (container[blockName].inited) continue;
                container[blockName].inited = true;

                container[blockName].send = function (r, i, c) {
                    container.send(this, r, i, c);
                }

                container[blockName].template = new Template(container[blockName]);

                container[blockName].init = function () {
                    for (i = 0; i < this.queue.length; i++) {
                        var e = this.queue[i];
                        this.send.apply(this, e)
                    };
                    delete this.queue;
                    
                    var self = this;

                    this.o('http://topisiders.local/teasers-list', {//http://topisiders.local/teasers-list
                        'limit': this.amountX * this.amountY,
                        'offset': this.offset,
                        'block_id': this.id
                    }, function (response) {
                        self.template.genBlock(response);
                        
                        console.log(response);
                    });
                };

                container[blockName].c = function (r, t) {
                    var n, o = document.head || document.documentElement;
                    if (!t) {
                        t = function () { }
                    } ;

                    n = document.createElement('script');
                    n.async = this.async || !0;
                    n.src = r;
                    n.onload = n.onreadystatechange = function (r, e) {
                        if (e || !n.readyState || /loaded|complete/.test(n.readyState)) {
                            n.onload = n.onreadystatechange = null;
                            if (n.parentNode) {
                                n.parentNode.removeChild(n)
                            } ;

                            n = null;
                            if (!e) {
                                t()
                            }
                        }
                    };

                    o.insertBefore(n, o.firstChild);
                    return n
                };

                container[blockName].o = function (e, n, o) {
                    var a = t(n),
                        i = 'topisiderC' + parseInt(Math.random() * 100000);
                    a.callback = i;
                    window[i] = function (e) {
                        delete window[i];
                        o(e)
                    };
                    var u = r(a);
                    e += '?' + u;
                    this.c(e)
                };

                container[blockName].init();
            }
        }

        container.initBlocks();
        
        function Template(block) {
            this.block = block;
            var self = this;
            
            this.genBlock = function (response) {
                self.domain = response.domain;
                self.container = n.getElementById("topisider-" + self.block.id);
                self.teaserItemHtml = response.blockHtml;

                // TODO: check this out
                self.container.setAttribute('style', "" + self.block.width + "" + self.block.widthUnits);
                
                self.addStyles(response.css);
                self.genTable(response.teasers);
            }
            
            this.addStyles = function (css) {
                var style = n.createElement('style');
                style.innerHTML = css.split("BLOCK-ID").join(self.block.id);
                self.container.appendChild(style);
            }
            
            this.genTable = function (teasers) {
                var table = n.createElement('table');
                var tbody = n.createElement('tbody');

                table.setAttribute('class', 'block-teasers-' + self.block.id);
                table.appendChild(tbody);
                self.container.appendChild(table);
                
                self.addRows(tbody, teasers);
            }
            
            this.addRows = function (tbody, teasers) {
                var rowTeasers = [];

                for (var i = 0; i < self.block.amountY; i++) {
                    rowTeasers = teasers.splice(0, self.block.amountX);
                    tbody.appendChild(self.genRow(rowTeasers));
                }
            }

            this.genRow = function (rowTeasers) {
                var row = n.createElement('tr');
                var col = null;
                var blockHtml = '';

                for (var i in rowTeasers) {
                    var colTeaser = rowTeasers[i];
                    col = n.createElement('td');
                    col.setAttribute('data-teaser-id', colTeaser.id);

                    // set url
                    blockHtml = self.teaserItemHtml.split(":link:").join("http://" + "link." + self.domain + "?post_id=" + colTeaser.editor_id + "&amp;teaser_id="+colTeaser.teaser_id + "&amp;web_site_id=" + self.block.siteId + "&amp;b_id=" + self.block.id + "&amp;lt_id=" + colTeaser.id);

                    blockHtml = blockHtml.split(":img:").join("http://" + self.domain + colTeaser.img);
                    blockHtml = blockHtml.split(":text:").join(colTeaser.text);

                    col.innerHTML = blockHtml;
                    row.appendChild(col);
                }

                return row;
            }
        }

        function t(e) {
            if (null == e || 'object' != typeof e) return e;
            if (e instanceof Date) {
                var n = new Date();
                n.setTime(e.getTime());
                return n
            } ;

            if (e instanceof Array) {
                var n = [];
                for (var r = 0, i = e.length; r < i; r++) {
                    n[r] = t(e[r])
                } ;
                return n
            } ;

            if (e instanceof Object) {
                var n = {};
                for (var o in e) {
                    if (e.hasOwnProperty(o)) n[o] = t(e[o])
                } ;

                return n
            } ;

            return{}
        };

        function r(e, n, t) {
            var a, r, i = [],
                o = function (n, e, t) {
                    var r, i = [];

                    if (e === !0) {
                        e = '1'
                    } else if (e === !1) {
                        e = '0'
                    } ;

                    if (e != null) {
                        if (typeof e === 'object') {
                            for (r in e) {
                                if (e[r] != null) {
                                    i.push(o(n + '[' + r + ']', e[r], t))
                                }
                            } ;

                            return i.join(t)
                        } else if (typeof e !== 'function') {
                            return encodeURIComponent(n) + '=' + encodeURIComponent(e)
                        } else {
                            throw new Error('There was an error processing for http_build_query().');
                        }
                    } else {
                        return ''
                    }
                };

            if (!t) {
                t = '&'
            } ;

            for (r in e) {
                a = e[r];

                if (n && !isNaN(r)) {
                    r = String(n) + r
                } ;

                var c = o(r, a, t);

                if (c !== '') {
                    i.push(c)
                }
            } ;

            return i.join(t)
        }
    }
)(window, document);
