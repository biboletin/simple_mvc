var $;
if ( typeof jQuery !== 'function' ) {
    $ = {}
}
(function() {
    $.anchors = {
        state: true,
        tog: function() {
            if ( $.anchors.state ) {
                $.anchors.off();
            } else {
                $.anchors.on();
            }
        },
        off: function() {
            var anchors = document.getElementsByTagName('a');
            for ( let i = 0; i < anchors.length; i++ ) {
                anchors[i].onclick = function() {
                    return false;
                }
            }
            $.anchors.state = false;
        },
        on: function() {
            var anchors = document.getElementsByTagName('a');
            for ( let i = 0; i < anchors.length; i++ ) {
                anchors[i].onclick = function() {
                    return true;
                }
            }
            $.anchors.state = true;
        }
    }
    $.measure = {
        start: function(name) {
            $.measure.used[name] = {
                start: Date.now()
            }
        },
        end: function(name) {
            if ( $.measure.used[name] ) {
                $.measure.used[name].end = Date.now();
                return name + ': ' + ($.measure.used[name].end - $.measure.used[name].start);
            }

        },
        used: {}
    };
    $.fonts = {
        swap: function(arr, el = document.body) { //[href, fontname, href, fontname...], el
            if ( $.fonts.ram.fonts.length === 0 ) {
                $.fonts.ram.fonts.push(getComputedStyle(el).fontFamily);
            }
            if ( (arr.length / 2) + 1 !== $.fonts.ram.fonts.length ) {
                for ( let i = 0; i < arr.length; i+=2 ) {
                    $.fonts.ram.fonts.push(arr[i+1]);
                    $.crEl({
                        tag: 'link',
                        loc: document.head,
                        href: arr[i]
                    });
                }
            }

            $.fonts.ram.cur = $.fonts.ram.cur === $.fonts.ram.fonts.length - 1 ? 0 : $.fonts.ram.cur + 1;

            el.style.fontFamily = $.fonts.ram.fonts[$.fonts.ram.cur];
        },
        ram: {
            cur: 0,
            fonts: []
        }
    };
    $.cl = function(log) {
        console.log(log);
    }
    $.crElKids = function(props, l, log = false) {
        let kidsArr = [];
        let tag = props.tag;
        delete props.tag;
        let propKeys = Object.keys(props);
        for ( let i = 0; i < l; i++ ) {
            let elObj = {
                tag: tag
            }
            for ( let p = 0; p < propKeys.length; p++ ) {
                switch(propKeys[p]) {
                    case 'click'://add all other events
                    case 'dblclick':
                    case 'mouseover':
                    case 'mouseout':
                    case 'wheel':
                    case 'mousewheel':
                    case 'class':
                    case 'style':
                    case 'kids':
                        elObj[propKeys[p]] = props[propKeys[p]];
                        break;

                    case 'attr':
                        elObj['attr'] = [];
                        let arr = props[propKeys[p]];
                        for ( let z = 0; z < arr.length; z+=2 ) {
                            let attr = arr[z];
                            let val = arr[z+1][i];
                            elObj['attr'].push(attr);
                            elObj['attr'].push(val);
                        }r
                        break;
                    default:
                        elObj[propKeys[p]] = props[propKeys[p]][i];
                }
            }
            kidsArr.push(elObj);
        }
        if (log) {
            console.log(kidsArr);
        }
        return kidsArr;
    }
    $.help = {
        new: {
            docRdy: '$.docRdy(fn{...code...}) - ie9',
            pauseEvent: '$.pauseEvent(e) - stops propagation and bubbling',
            clearSelection: '$.clearSelection() - clears selected elements',
            isInViewport: '$.isInViewport(element) - returns true if element is in view port',
            toClipBoard: 'toClipBoard(string, log = false) - copies string to clipboard',
            nodeType: '$.nodeType(element) - returns nodelist, node, text, comment, n/a',
            crEl: '$.crEl(obj) - creates and append elements.\nobj at least = { tag: "div", loc: element || string }\nSupported: class, id, html, text, href, target, style, src, name, value, type, attr:["at1", "val1"]',
            buildCP: '$.buildCP(cont, fn(col){}) - builds cp and executes on color change fn with first arg received col as hsla color ',
            date: '$.date() - returns obj with current date&time info',
            twoKeysDown: '$.twoKeysDown([key1, key2, f1, key3, key4, fn2]) - executes fn on simultaneous key press; works with multiple',
            hovDom: '$.hovDom.tog(name, callback, ignore)\nOn first call start dom hovering;\nOn click picks element.\nOn second call stops dom hovering and executes callback, passing an array with picked elements as first argument.\nIgnore - single element || array of single elements || htmlcollection || nodelist to be ignored if picked;',
            info: '$.info() - returns browser and os info',

            resizable: '$(jquerySel).resizable() - make element resizable (not working for some reason)',
            move: '$(jquerySel).move() - make all jquery elements draggable',

            distArr: '$.distArr(arr) - returns {arr: arrWithoutDublicates, info: {key1: numOfOccurrencies} }',
            searchText: 'grep -r -i -l "search phrase" ./', //-r[recursive] -i[case insensitive] -l[return only file paths]
            extractZipsToFolder: 'look coment',// find -name '*.zip' -exec sh -c 'unzip -d "${1%.*}" "$1"' _ {} \;
            findAndReplace: 'sed -i "s/from/to/g" ./footer.php',
            s: '$.s(selector) - querySelectorAll',
            tog: '$.tog(el1-trig, el2-tog)',
            noteBook: '$.noteBook("local sotrage item name") - creates movable textarea, value is saved in window.loalStorage (on enter key) and loaded once; "clear" as second arg; "log || get" as first;'
        },
        ubuntu: {
            wget: 'wget --mirror --convert-links --adjust-extension --page-requisites --no-parent https://livedemo00.template-help.com/wt_58887_v2/',
            shutdown: 'sudo shutdown -P now',
            reboot: 'reboot --r',
            commands: [
                'scp -r /var/www/html/pi/ pi@192.168.100.55:/var/www/html/pi',
                'ls',
                'ps', //[process status]lists currently running processes
                'lshw',//pc info
                'xdg-open',//opens file
                'alias blqblq="command"',// - adds another name // permanent - put in ~/.bashrc
                'rm -rf x',//deletes recurs
                'mv',//mv pathName name; mv pathName path - changes name / loc
                'chmod and own',
                'localtunnel',//open to local network
                'df -Th ' //disc usage by partitions
            ],
            etc: [
                'xinput; xinput --list-props N',
                'xinput --set-prop N "Synaptics Finger" 45, 45, 150',
                'dpkg --list',//instaled software
                'pavucontrol',//sound control
                'simplescreenrecored'
            ],
            conn: {
                local: {
                    whoIs: 'nmap -sP 192.168.x.0/24',
                    // nmap -sV 192.168.43.1
                    //scan opened ports
                    // nmap --top-ports 20 192.168.1.106
                    //scan top ports
                    // nmap -Pn --script vuln 192.168.0.10
                    //check vuln
                    // ssh -L 8123:78.83.214.86:10000 pi@2.tcp.ngrok.io -p10607
                },
                public: {
                    openedPots: 'sudo lsof -i -P -n | grep LISTE'
                },

                ssh: {
                    con: 'ssh user@ip',
                    conWithPort: 'ssh user@ip -p123124',
                    supportsGraphic: 'ssh -Y user@ip',
                    tunnelFromSshToLocal: 'ssh -L 8123:localhost:30201 user@78.83.214.86 -p5022',

                },

                apache: {
                    start: 'sudo service apache2 start',
                    start2: 'sudo /etc/init.d/mysql start',
                    stop: 'sudo service apache2 stop',
                    restart: 'sudo service apache2 restart'
                }
            },
            pi: [
                'pinout',
                'raspi-config',
                'fswebcam -S 15 image10.jpeg',
                '/etc/rc.local', //add commands in this file on boot
                //vnc start/stop
                'systemctl start vncserver-x11-serviced.service #systemd',
                'systemctl stop vncserver-x11-serviced.service #systemd'
            ],
            git: [
                'git init',
                'git add .',
                'git commit -m "lorem"',
                'git push origin master',
                'git stash => save changes to stash',
                'git branch bugfixA => make a branch',
                'git checkout bugfixA =>change to branch',
                'git stash pop => “paste” to branch',
                'git commit --m "haha"',
                'git push origin bugfixA',
                'git checkout master',
            ]
        }
    };

    $.crEl = function( elInfo ) {
        if ( elInfo === undefined ) { return console.log('no argument provided for $.crEl()'); }

        if ( Array.isArray(elInfo) ) {
            for ( let i = 0; i < elInfo.length; i++ ) {
                $.crEl( elInfo[i] );
            }
            return;
        }
        //if its only text / text + loc
        if ( elInfo.tag === undefined ) {

            if ( elInfo.text !== undefined ) {
                var text = document.createTextNode(elInfo.text);
                    if ( elInfo.loc === undefined ) {
                    document.body.appendChild(text);
                } else if ( typeof elInfo.loc === 'string' ) {
                    document.querySelector(elInfo.loc).appendChild(text);
                } else if ( elInfo.loc.nodeType === 1 ) {
                    elInfo.loc.appendChild(text);
                }
            } else {
                console.log('Provide at least {text:"foo"} or {tag: "foo"}');
            }
            return;
        }

        var el = document.createElement(elInfo.tag);
        var keys = Object.keys(elInfo);
        for ( let i = 0; i < keys.length; i++ ) {
            var key = keys[i];
            switch ( key.toLowerCase() ) {
                case 'text':
                    var text = document.createTextNode(elInfo[key]);
                    el.appendChild(text);
                    break;
                case 'html':
                    el.innerHTML = elInfo[key];
                    break;
                case 'attr':
                    for ( let y = 0; y < elInfo[key].length; y+=2 ) {
                       el.setAttribute( elInfo[key][y], elInfo[key][y+1] );
                    }
                    break;
                case 'href':
                case 'style':
                case 'src':
                case 'class':
                case 'id':
                case 'name':
                case 'value':
                case 'type':
                case 'target':
                case 'placeholder':
                case 'title':
                    el.setAttribute( key, elInfo[key] );
                    break;
                case 'kids':
                    var kids = elInfo.kids;
                    if ( !Array.isArray(kids) ) {
                        kids = [kids];
                    }
                    for ( let y = 0; y < kids.length; y++ ) {
                       let kid = kids[y];
                          kid.loc = el;
                       $.crEl(kid);
                    }
            }
        }
        //if anchor and target - add noref&noopener
        if ( elInfo.tag === 'a' && elInfo.target ) {
            el.setAttribute('rel', 'noreferrer noopener');
        }
        //append
        if ( elInfo.loc === undefined ) {
            document.body.appendChild(el);
        } else if ( typeof elInfo.loc === 'string' ) {
            document.querySelector(elInfo.loc).appendChild(el);
        } else if ( elInfo.loc.nodeType === 1 ) {
            elInfo.loc.appendChild(el);
        } else if ( typeof elInfo.loc === 'object' && elInfo.loc.constructor === Object ) {
            var place = Object.keys(elInfo.loc)[0];
            var relEl = typeof elInfo.loc[place] === 'string' ? document.querySelector(elInfo.loc[place]) : elInfo.loc[place];
            var ind;
            if ( place.indexOf('index') === 0 ) {
                ind = place.slice(5);
                place = place.slice(0, 5);
            }

            switch ( place ) {
                case 'before':
                    relEl.parentNode.insertBefore(el, relEl);
                    break;
                case 'after':
                    relEl.parentNode.insertBefore(el, relEl.nextSibling);
                    break;
                case 'first':
                    var firstEl = relEl.childNodes[0];
                    relEl.insertBefore(el, firstEl);
                    break;
                case 'index':
                    var kidsWithTexts = relEl.childNodes;
                    var kids = [];
                    for ( let i = 0; i < kidsWithTexts.length; i++ ) {
                        if ( kidsWithTexts[i].nodeType === 1  ) {
                            kids.push(kidsWithTexts[i])
                        }
                    }
                    ind = ind > kids.length ? kids.length : ind;
                    relEl.insertBefore(el, kids[ind - 1]);
                    break;
            }
        }

        var evList = [
            'click', 'dblclick', 'mousedown', 'mouseup', 'contextmenu',
            'mouseover', 'mouseout', 'mousemove', 'mousewheel', 'wheel',
            'touchstart', 'touchmove', 'touchend', 'touchcancel',
            'keydown', 'keypress', 'keyup', 'input', 'invalid',
            'focus', 'blur', 'change', 'submit',
            'scroll', 'resize', 'hashchange', 'load', 'unload'
        ];

        for ( let i = 0; i < evList.length; i++ ) {
            var eventType = evList[i];

            if ( elInfo[eventType] ) {
                el.addEventListener(eventType, elInfo[eventType]);
            }
        }

        if ( elInfo.fn && typeof elInfo.fn === 'function' ) {
            elInfo.fn(el);
        }

        return el;
    };
    $.buildCP = function (cont, fn) {//allmost
        let cpListener = $.crEl({
            tag: 'span',
            loc: cont,
            class: 'cp',
            attr: [
                'style', 'position: relative; display: inline-block; margin: 10px; width: 15px; height: 15px; border: 1px solid black;'
            ],
        });

        var cp = $.crEl({
            tag: "div",
            class: 'colorpicker',
            style: 'display: none; position: absolute; right: -188px; bottom: -75px; z-index: 999999999; width: 360px; height: 150px;  border: 2px solid black; background: -webkit-linear-gradient(left, hsla(0, 50%, 50%, 1),hsla(10, 50%, 50%, 1),hsla(20, 50%, 50%, 1),hsla(30, 50%, 50%, 1),hsla(40, 50%, 50%, 1),hsla(50, 50%, 50%, 1),hsla(60, 50%, 50%, 1),hsla(70, 50%, 50%, 1),hsla(80, 50%, 50%, 1),hsla(90, 50%, 50%, 1),hsla(100, 50%, 50%, 1),hsla(110, 50%, 50%, 1),hsla(120, 50%, 50%, 1),hsla(130, 50%, 50%, 1),hsla(140, 50%, 50%, 1),hsla(150, 50%, 50%, 1),hsla(160, 50%, 50%, 1),hsla(170, 50%, 50%, 1),hsla(180, 50%, 50%, 1),hsla(190, 50%, 50%, 1),hsla(200, 50%, 50%, 1),hsla(210, 50%, 50%, 1),hsla(220, 50%, 50%, 1),hsla(230, 50%, 50%, 1),hsla(240, 50%, 50%, 1),hsla(250, 50%, 50%, 1),hsla(260, 50%, 50%, 1),hsla(270, 50%, 50%, 1),hsla(280, 50%, 50%, 1),hsla(290, 50%, 50%, 1),hsla(300, 50%, 50%, 1),hsla(310, 50%, 50%, 1),hsla(320, 50%, 50%, 1),hsla(330, 50%, 50%, 1),hsla(340, 50%, 50%, 1),hsla(350, 50%, 50%, 1),hsla(360, 50%, 50%, 1));',
            loc: cpListener,
            kids: [{
                tag: 'div',
                loc: cp,
                style: 'width: 100%; height: 100%; background: linear-gradient(to bottom, rgba(0,0,0,0.9), rgba(0,0,0,0.4), rgba(0,0,0,0), rgba(255,255,255,0.4), rgba(255,255,255,0.9));'
            }]
        });

        cpListener.addEventListener('mousedown', function(e) {
            var mouse = {
                top: e.offsetY,
                left: e.offsetX
            }

            cp.style.display = 'block';

            var currentColor = {};
            var opacity = 10;

            cp.addEventListener('mousemove', changeColor);
            cp.addEventListener('wheel', setOpacity);

            document.addEventListener('mouseup', stopChangingColor);

            function changeColor(e) {
                mouse = {top: e.offsetY,left: e.offsetX};

                var hslBGColor = 'hsla(' + mouse.left + ", " + Math.floor(String(mouse.top / 1.5)) + "%, " + Math.floor(String(mouse.top / 1.5)) + '%, ' + opacity / 10 + ')';

                cpListener.style.background = currentColor = hslBGColor;

                if ( typeof fn !== 'undefined' ) {
                    fn(hslBGColor);
                }
            }

            function stopChangingColor () {
                cp.style.display = 'none';

                cp.removeEventListener('mousemove', changeColor);
                cp.removeEventListener('wheel', setOpacity);
                document.removeEventListener('mouseup', stopChangingColor);
            }

            function setOpacity(e) {
                $.pauseEvent(e);

                if ( event.deltaY < 0 ) {
                    opacity += 0.5;
                    if ( opacity === 10.5 ) {
                        return opacity = 10;
                    }
                } else if ( event.deltaY > 0 ) {
                    opacity -= 0.5;
                    if ( opacity === -0.5 ) {
                        return opacity = 0;
                    }
                }
                changeColor(e);
            }
        });

        return cpListener;
    };
    $.move = function(els) {
        if ( !els.length || els.length === 1 ) {
            els = [els];
        }
        for ( let i = 0; i < els.length; i++ ) {
            var el = els[i];

            if ( window.getComputedStyle(el).position !== 'relative' && window.getComputedStyle(el).position !== 'fixed' ) {
                el.style.position = 'relative';
            }
            if ( el.style.zIndex !== '9999999' ) {
                el.style.zIndex = '9999999';
            }

            var pos;
            moveRam.push({
                el: el,
                onEnd: onEnd
            });
            
            el.addEventListener('mousedown', $.mqstartElementMovement);
        }
    };
    var moveRam = [{active: undefined}];
    $.move = function(els, onEnd = false) {
        if ( !els.length || els.length === 1 ) {
            els = [els];
        }
        for ( let i = 0; i < els.length; i++ ) {
            var el = els[i];

            if ( window.getComputedStyle(el).position !== 'relative' && window.getComputedStyle(el).position !== 'fixed' ) {
                el.style.position = 'relative';
            }
            if ( el.style.zIndex !== '9999999' ) {
                el.style.zIndex = '9999999';
            }

            var pos;
            moveRam.push({
                el: el,
                onEnd: onEnd
            });
            el.addEventListener('mousedown', $.mqstartElementMovement);
        }
    };
    $.mqstartElementMovement = function(e) {
        if ( this.classList.value.indexOf('resizing') !== -1 ) {
            return;
        }
        moveRam[0].active = this;
        pos = {
            m: {
                top: Number(e.clientY),
                left: Number(e.clientX)
            },
            el: {
                top: Number(window.getComputedStyle(this).top.slice(0, -2)),
                left: Number(window.getComputedStyle(this).left.slice(0, -2))
            },
            selector: this,
            position: window.getComputedStyle(this).position
        };
        document.addEventListener('mousemove', $.mqmoveElement);
        document.addEventListener('mouseup', $.mqstopElementMovement);
    };
    $.mqstopElementMovement = function(e) {
        document.removeEventListener('mouseup', $.mqstopElementMovement);
        document.removeEventListener('mousemove', $.mqmoveElement);

        let thisEl = moveRam[0].active;
        let callback;

        for ( let i = 1; i < moveRam.length; i++ ) {
            let moveEl = moveRam[i].el;

            if ( moveEl.isSameNode(thisEl) ) {
                callback = moveRam[i].onEnd;
                break;
            }
        }

        if ( callback ) {
            callback(e, thisEl);
        }

        moveRam[0].active = undefined;
    };
    // $.mqstartElementMovement = function(e) {
    //     if ( this.classList.value.indexOf('resizing') !== -1 ) {
    //         return;
    //     }
    //     pos = {
    //         m: {
    //             top: Number(e.clientY),
    //             left: Number(e.clientX)
    //         },
    //         el: {
    //             top: Number(window.getComputedStyle(this).top.slice(0, -2)),
    //             left: Number(window.getComputedStyle(this).left.slice(0, -2))
    //         },
    //         selector: this,
    //         position: window.getComputedStyle(this).position
    //     };
    //     document.addEventListener('mousemove', $.mqmoveElement);
    //     document.addEventListener('mouseup', $.mqstopElementMovement);
    // };
    // $.mqstopElementMovement = function() {
    //     document.removeEventListener('mouseup', $.mqstopElementMovement);
    //     document.removeEventListener('mousemove', $.mqmoveElement);
    // };
    $.mqmoveElement = function(e) {
        $.pauseEvent(e);
        var top, left;

            top = pos.el.top + (event.clientY - pos.m.top);
            left = pos.el.left + (event.clientX - pos.m.left);

        pos.selector.style.top = top + 'px';
        pos.selector.style.left = left + 'px';
    };
    $.hovDom = {//depends on $.pauseEvent; works well with twokeysdown
        tog: function(name, then, ignore) {
            if ( name === undefined ) {
                console.log($.help.new.hovDom);
                return;
            }
            if ( $.hovDom.ram.activeName === name) {
                $.hovDom.stop(name);
                if ( then ) {
                    then( $.hovDom.ram[name].pickedEls, name, $.hovDom.curStartIndex);
                }
            } else {
                $.hovDom.start(name, ignore);
            }
        },
        start: function(name, ignore) {
            let ram = $.hovDom.ram;
            if ( !ram[name] ) {
                ram[name] = {
                    pickedEls: [],
                    ignore: ignore &&
                    (
                        Array.isArray(ignore)
                        || NodeList.prototype.isPrototypeOf(ignore)
                        || HTMLCollection.prototype.isPrototypeOf(ignore)
                    )
                        ? ignore : [ignore]
                };
            }
            $.hovDom.curStartIndex = $.hovDom.ram[name].pickedEls.length;

            if ( ram.active ) {
                if ( ram.activeName === name ) {
                    $.hovDom.stop(ram.activeName);
                    return;
                } else {
                    $.hovDom.stop(ram.activeName);
                }
            }

            ram.active = true;
            ram.activeName = name;

            document.addEventListener('mousemove', $.hovDom.changeBorderOnHover);
            document.addEventListener('mousedown', $.hovDom.returnClickedElement);
        },
        stop: function(name) {
            document.removeEventListener('mousemove', $.hovDom.changeBorderOnHover);
            document.removeEventListener('mousedown', $.hovDom.returnClickedElement);

            let ram = $.hovDom.ram;
            if ( ram.lastEl ) {
                ram.lastEl.style.border = ram.lastElBord;
            }
            ram.active = false;
            ram.activeName = undefined;
        },
        ram: {
            active: false,
            activeName: undefined,
            lastEl: undefined,
            lastElBord: undefined,
            curStartIndex: null
        },
        changeBorderOnHover: function(e) {
            $.pauseEvent(e);
            let ram = $.hovDom.ram;
            let curEl = document.elementFromPoint(event.clientX, event.clientY);

            if ( curEl === null ) {
                return;
            }

            if (ram.lastEl === undefined) {
                ram.lastEl = curEl;
                ram.lastElBord = getComputedStyle(curEl).border;
                ram.lastEl.style.border = '1px solid red;';
            }

            if (ram.lastEl === curEl) { return; }

            ram.lastEl.style.border = ram.lastElBord;
            ram.lastEl = curEl;
            ram.lastElBord = getComputedStyle(curEl).border;

            curEl.style.border = '1px solid red';
        },
        returnClickedElement: function(e) {
            $.pauseEvent(e);
            let ram = $.hovDom.ram[$.hovDom.ram.activeName];
            let ignoredElements = ram.ignore;
            let pickedElement = document.elementFromPoint(event.clientX, event.clientY);
            for ( let i = 0; i < ignoredElements.length; i++ ) {
                if ( ignoredElements[i] === pickedElement ) {
                    return;
                }
            }
            if (ram.pickedEls.length === 0 ) {
                ram.pickedEls.push(pickedElement);
            }

            let notYetPicked = true;
            for ( let i = 0; i < ram.pickedEls.length; i++ ) {
                if ( ram.pickedEls[i] === pickedElement ) {
                    notYetPicked = false;
                }
            }
            if (notYetPicked) {
                ram.pickedEls.push(pickedElement);
            }
        }
    }

    function returnElInfoObj(el, e) {
        let fullWidth = Number( getComputedStyle(el).width.replace('px', '') ) +
            Number( getComputedStyle(el).paddingLeft.replace('px', '') ) +
            Number( getComputedStyle(el).paddingRight.replace('px', '') ) +
            Number( getComputedStyle(el).borderLeftWidth.replace('px', '') ) +
            Number( getComputedStyle(el).borderRightWidth.replace('px', '') );
        let fullHeight = Number( getComputedStyle(el).height.replace('px', '') ) +
            Number( getComputedStyle(el).paddingTop.replace('px', '') ) +
            Number( getComputedStyle(el).paddingBottom.replace('px', '') ) +
            Number( getComputedStyle(el).borderTopWidth.replace('px', '') ) +
            Number( getComputedStyle(el).borderBottomWidth.replace('px', '') );

        return {
            w: fullWidth,
            h: fullHeight,
            ex: e.clientX,
            ey: e.clientY,
            top: el.getBoundingClientRect().top,
            left: el.getBoundingClientRect().left
        };
    }
    $.resizable = function(els, dir = 'both') {
        dir = typeof dir === 'string' ? dir.toLowerCase() : 'both';

        var ram = {
            cursor: getComputedStyle(document.body).cursor
        };
        for ( let i = 0; i < els.length; i++) {
            let el = els[i];

            if (getComputedStyle(el).position !== 'fixed') {
                el.style.position = 'relative';
            }
            let info = {
                cursorType: dir === 'width' ? 'ew-resize' :
                            dir === 'height' ? 'ns-resize':
                                                "nwse-resize"
            };
            el.addEventListener('mousemove', function(e) {
                let z = info.dimensions;


                if ( !z ) {
                    info.dimensions = returnElInfoObj(this, e);
                    z = info.dimensions;
                }

                let elTop = Number( this.style.top.replace('px', '') );
                let elLeft = Number( this.style.left.replace('px', '') );

                console.log(elTop === z.top, elLeft === z.left);
                console.log(elTop, z.top)
                if ( z.h + z.top - e.clientY < 15 &&
                    z.w + z.left - e.clientX < 15
                ) {
                    if ( this.classList.value.indexOf('cursor') === -1 ) {
                        this.classList.add('cursor');
                        this.classList.add(info.cursorType);
                    }
                } else {
                    this.classList.remove('cursor');
                }

            });
            el.addEventListener('mousedown', function(e) {
                e.stopPropagation();
                info.dimensions = returnElInfoObj(el, e);
                //determine whether el is clicked in bottom right corner - then start resizing
                let z = info.dimensions;
                if ( z.h + z.top - e.clientY < 15 &&
                    z.w + z.left - e.clientX < 15
                ) {
                    this.classList.add('resizing');
                    document.addEventListener('mousemove', startElementResizing);
                    document.addEventListener('mouseup', stopElementResizing);
                }
            });

            function startElementResizing(e) {
                $.pauseEvent(e);
                let dim = info.dimensions;
                let addW = e.clientX - dim.ex;
                let addH = e.clientY - dim.ey;

                let newW = (dim.w + addW) < 0 ? 0 : (dim.w + addW);
                let newH = (dim.h + addH) < 0 ? 0 : (dim.h + addH);

                el.style.width = newW + 'px';
                el.style.height = newH + 'px';
            }

            function stopElementResizing(e) {
                document.removeEventListener('mousemove', startElementResizing);
                document.removeEventListener('mouseup', stopElementResizing);
                info.dimensions = returnElInfoObj(el, e);
                console.log(el);
                el.classList.remove('resizing');
            };
        }

    }

   // $.hotkeys = function(arrOfArrs, log = false) {
   //      var map = {};
   //      onkeydown = onkeyup = function(e){
   //          e = e || event; // IE...
   //          map[e.key] = e.type == 'keydown';
   //          var mapKeys = Object.keys(map);
   //          var onlyOnce = 0;//otherwise fires 3 times the funtion when clicking combo of 2 keys
   //          for ( let i = 0; i < arrOfArrs.length; i++ ) {
   //              if (onlyOnce !== 0) {
   //                  return;
   //              }
   //              onlyOnce++;
   //              let arr = arrOfArrs[i];
   //              let fn = arr[arr.length - 1];
   //                  arr = arr.slice(0, -1);
   //              let run = false;

   //              for ( let p = 0; p < arr.length; p++ ) {

   //                  console.log(map[arr[p]])
   //              }
   //              if ( run ) {
   //                  fn();
   //              }
   //          }
   //          if (log) {
   //              console.log(map);
   //          }
   //          return;
   //          for ( let i = 0; i < mapKeys.length; i++ ) {
   //              if ( onlyOnce !== 0 ) { return; }
   //              for ( let p = 0; p < arrOfArrs.length; p++ ) {
   //                  if ( map[ arr[p] ] && map[ arr[p+1] ] ) {
   //                      arr[p+2](e);

   //                      onlyOnce++;
   //                  }
   //              }
   //          }
   //      }
   //  };
   //  $.hotkeys([
   //      ['a','s', 'd', function() {
   //          console.log(1)
   //      }],
   //      ['a', 's', function() {
   //          console.log(2)
   //      }]
   //  ]);
    $.twoKeysDown = function(arr, log = false) {
        var map = {};
        onkeydown = onkeyup = function(e){
            e = e || event; // IE...
            map[e.key] = e.type == 'keydown';
            var mapKeys = Object.keys(map);
            var onlyOnce = 0;//otherwise fires 3 times the funtion when clicking combo of 2 keys
            for ( let i = 0; i < mapKeys.length; i++ ) {
                if (log) {
                    console.log(map);
                }
                if ( onlyOnce !== 0 ) { return; }
                for ( let p = 0; p < arr.length; p+=3 ) {
                    if ( map[ arr[p] ] && map[ arr[p+1] ] ) {
                        arr[p+2](e);

                        onlyOnce++;
                    }
                }
            }
        }
    };
    $.pauseEvent = function(e) {
        if(e.stopPropagation) e.stopPropagation();
        if(e.preventDefault) e.preventDefault();
        e.cancelBubble = true;
        e.returnValue = false;
        return false;
    };
     $.toClipBoard = function(string, log = false) {
        var textArea = document.createElement('textarea');
            textArea.style.width = '100%';
            textArea.style.height = '100vh';
            textArea.textContent = string;

        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        if ( log ) {
            console.log('Text copied to clipboard:', string);
        }
    };
    $.noteBook = function(bookName, clear = false) {
            performance.mark('start');

        var bookName = bookName;
        var locStor = window.localStorage;
        var books = locStor.getItem('mquery-notebooks') ? JSON.parse(locStor.getItem('mquery-notebooks')) : {};
        if ( bookName.toLowerCase() === 'log' || bookName.toLowerCase() === 'get') {
            console.log(books);
            return books;
        }
        if ( bookName.toLowerCase() === 'code' ) {
            var dependencies = [ 'pauseEvent', 'toClipBoard', 'crEl', 'move', 'mqstartElementMovement', 'mqstopElementMovement', 'mqmoveElement', 'crElKids', 'noteBook'];
            var combinedJsCode =`var $; if ( typeof jQuery !== 'function' ) { $ = {}; }\n`;

            for ( let i = 0; i < dependencies.length; i++ ) {
                combinedJsCode += '$.' + dependencies[i] + ' = ' + $[dependencies[i]].toString() + '\n';
            }
            combinedJsCode += '$.noteBook("log")';
            console.log(combinedJsCode)
            return;
        }

        $.move(
            $.crEl({
                tag: 'div',
                style: 'width: 250px; height: 300px; box-sizing: border-box',
                id: 'notebook',
                kids: [{
                    tag: 'textarea',
                    id: 'notebook-ta',
                    style: 'width: 100%; height: 100%; resize: none; padding-top: 30px;',
                    text: books[bookName] ? books[bookName] : '',
                    keydown: function(e) {
                        if ( e.key === 'Enter' ) {
                            books[bookName] = this.value;
                            locStor.setItem('mquery-notebooks', JSON.stringify(books));
                        }
                    },
                    fn: function() {
                        if ( clear ) {
                            var clearBookName = books;
                            delete clearBookName[bookName];
                            locStor.setItem('mquery-notebooks', JSON.stringify(clearBookName));
                        }
                    }
                },
                {
                    tag: 'div',
                    id: 'books-buttons',
                    style: 'position: absolute; top: 0; left: 0; width: 100%; z-index: 99999999; border: 2px solid black; background: white',
                    kids: $.crElKids(
                        {
                            tag: 'span',
                            style: 'padding: 1px 3px; border-right: 1px solid gray; cursor: pointer; display: inline-block',
                            text: Object.keys(books),
                            click: function(e) {
                                console.log('noo')
                                var lastNotes = this.parentNode.parentNode.getElementsByTagName('textarea')[0].value;
                                if ( this.textContent === bookName ) {
                                    $.toClipBoard(lastNotes);
                                    return;
                                }
                                books[bookName] = lastNotes;
                                locStor.setItem('mquery-notebooks', JSON.stringify(books));
                                this.parentNode.parentNode.remove();
                                $.noteBook(this.textContent);
                            },
                            mousedown: function(e) {
                                $.pauseEvent(e);
                                console.log(5)
                            }
                        },
                        Object.keys(books).length
                    ),
                    fn: function(els) {
                        var spans = els.parentNode.getElementsByTagName('span');
                        for ( let i = 0; i < spans.length; i++ ) {
                            let curBookName = spans[i].textContent;
                            if ( curBookName === bookName ) {
                                spans[i].classList.add('active');
                            }
                        }
                    }
                },
                {
                    tag: 'style',
                    loc: document.head,
                    text: `
                        #books-buttons span.active {
                            color: white;
                            background: black;
                        }
                        #notebook-ta::-webkit-scrollbar {
                            width: 5px;
                        }#notebook-ta::-webkit-scrollbar-thumb {
                            background: black;
                        }
                    `
                }]
            })
        );
    };

    $.distArr = function(arr) {
        var obj = arr.reduce(function (acc, curr) {
            acc[curr] ? acc[curr]++ : acc[curr] = 1;
            return acc;
        }, {});

        return {arr: Object.keys(obj), info: obj};
    }
    $.date = function() {
        var now = new Date;

        var day = now.getDate();
        if ( day < 10 ) { day = "0" + day };

        var month = now.getMonth() + 1;
        if ( month < 10 ) { month = "0" + month };

        var year = now.getFullYear();

        var seconds = now.getSeconds();
        if ( seconds < 10 ) { seconds = "0" + seconds };

        var minutes = now.getMinutes();
        if ( minutes < 10 ) { minutes = "0" + minutes };

        var hours = now.getHours();
        if ( hours < 10 ) { hours = "0" + hours };

        var time = hours + ":" + minutes + ":" + seconds;
        var date = day + "/" + month + "/" + year;

        return {time: time, date: date, year: year, month: month, day: day, hour: hours, minute: minutes, second: seconds};
    };
    $.nodeType = function(el) {
        if (!el || el.length === 0) return 'n/a';

        var arr = [];
        var nl = 0;

        if (el.length) {
            for ( let i = 0; i < el.length; i++ ) {
                arr.push(toStr(el[i].nodeType));
                nl++;
            }
            if (nl === el.length) {
                return 'nodeList';
            } else {
                return arr;
            }
        } else {
            return toStr(el.nodeType);
        }

        function toStr(nt) {
            if (nt === 1) return 'node';
            if (nt === 3) return 'text';
            if (nt === 8) return 'comment';
        }
    };


    $.clearSelection = function() {
        if ( document.selection && document.selection.empty ) {
            document.selection.empty();
        } else if ( window.getSelection ) {
            var sel = window.getSelection();
            sel.removeAllRanges();
        }
    };
    $.docRdy = function(fn) {
        if (document.readyState === "complete" || document.readyState === "interactive") {
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    };
    $.isInViewport = function(el) {
        var rect = el.getBoundingClientRect();
        var html = document.documentElement;
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || html.clientHeight) &&
            rect.right <= (window.innerWidth || html.clientWidth)
        );
    };

    $.info = function(returnType = 'str') {
       var module1 = {
          options: [],
          header: [navigator.platform, navigator.userAgent, navigator.appVersion, navigator.vendor, window.opera],
          dataos: [
             { name: 'Windows Phone', value: 'Windows Phone', version: 'OS' },
             { name: 'Windows', value: 'Win', version: 'NT' },
             { name: 'iPhone', value: 'iPhone', version: 'OS' },
             { name: 'iPad', value: 'iPad', version: 'OS' },
             { name: 'Kindle', value: 'Silk', version: 'Silk' },
             { name: 'Android', value: 'Android', version: 'Android' },
             { name: 'PlayBook', value: 'PlayBook', version: 'OS' },
             { name: 'BlackBerry', value: 'BlackBerry', version: '/' },
             { name: 'Macintosh', value: 'Mac', version: 'OS X' },
             { name: 'Linux', value: 'Linux', version: 'rv' },
             { name: 'Palm', value: 'Palm', version: 'PalmOS' }
          ],
          databrowser: [
             { name: 'Chrome', value: 'Chrome', version: 'Chrome' },
             { name: 'Firefox', value: 'Firefox', version: 'Firefox' },
             { name: 'Safari', value: 'Safari', version: 'Version' },
             { name: 'Internet Explorer', value: 'MSIE', version: 'MSIE' },
             { name: 'Opera', value: 'Opera', version: 'Opera' },
             { name: 'BlackBerry', value: 'CLDC', version: 'CLDC' },
             { name: 'Mozilla', value: 'Mozilla', version: 'Mozilla' }
          ],
          init: function () {
             var agent = this.header.join(' '),
                os = this.matchItem(agent, this.dataos),
                browser = this.matchItem(agent, this.databrowser);

             return { os: os, browser: browser };
          },
          matchItem: function (string, data) {
             var i = 0,
                j = 0,
                html = '',
                regex,
                regexv,
                match,
                matches,
                version;

             for (i = 0; i < data.length; i += 1) {
                regex = new RegExp(data[i].value, 'i');
                match = regex.test(string);
                if (match) {
                   regexv = new RegExp(data[i].version + '[- /:;]([\\d._]+)', 'i');
                   matches = string.match(regexv);
                   version = '';
                   if (matches) { if (matches[1]) { matches = matches[1]; } }
                   if (matches) {
                      matches = matches.split(/[._]+/);
                      for (j = 0; j < matches.length; j += 1) {
                         if (j === 0) {
                            version += matches[j] + '.';
                         } else {
                            version += matches[j];
                         }
                      }
                   } else {
                      version = '0';
                   }
                   return {
                      name: data[i].name,
                      version: parseFloat(version)
                   };
                 }
             }
             return { name: 'unknown', version: 0 };
          }
       };

       var e = module1.init();

       var clientInfo = {
          os: e.os.name + ' v' + e.os.version,
          browser: e.browser.name + ' v' + e.browser.version,

          dimensions: {
             bodyWidth: getComputedStyle(document.body).width + 'px',
             bodyHeight: getComputedStyle(document.body).height + 'px',
             windowWidth: window.innerWidth + 'px',
             windowHeight: window.innerHeight + 'px'
          },

          navigator: {
             userAgent: navigator.userAgent,
             appVersion: navigator.appVersion,
             platform: navigator.platform,
             vendor: navigator.vendor
          }
       };


       if ( returnType === 'str' || returnType === 'string' || returnType === 'text') {
          clientInfo = JSON.stringify(clientInfo, null, 4);
       }

       return clientInfo;
    };

    $.s = function(sel, context = document) {
        if ( typeof context === 'string' ) {
            context = document.querySelector(context);
        }
        var el = typeof sel === 'string' ?
            context.querySelectorAll(sel) :
                sel;

        return el;
    }
    $.ev = function(el, ev, fn) {
        if ( !el.length ) {
            el.addEventListener(ev, fn);
        } else {
            for ( let i = 0; i < el.length; i++ ) {
                el[i].addEventListener(ev, fn);
            }
        }
    }
    $.tog = function(trig, tog) {
        var display = getComputedStyle(tog).display;
        display = display === 'none' ? 'block' : display;
        trig.addEventListener('click', function(e) {
            var state = getComputedStyle(tog).display;
            if ( state === 'none' ) {
                tog.style.display = display;
            } else {
                tog.style.display = 'none';
            }
        });
    }

    $.getCss = function(el, prop) {
        return window.getComputedStyle(el)[prop];
    }

    //not yet!
    $.findAndReplace = function(str, from, toNext) {
        var regex = new RegExp(from,"g"),
            result, ind = [], endInd = [], finalArr = [];

        while ( (result = regex.exec(str)) ) {
            ind.push(result.index + from.length);
        }
        for ( let i = 0; i < ind.length; i++ ) {
            endInd.push( str.indexOf(toNext, ind[i] + from.length) );
        }
        for ( let i = 0; i < ind.length; i++ ) {
            var cont = str.slice(ind[i], endInd[i]);
            if ( cont === '' || cont.indexOf('#') === 0 || cont.indexOf('tel:') === 0 || cont.indexOf('mailto:') === 0) {
                continue;
            }
            finalArr.push(cont);
        }
        return finalArr.length > 0 ? finalArr : false;
    }
})();




// var $ = typeof jQuery !== 'function' ? {} : $;
// (function() {
//     $.help = {
//         fns: ['cl', 'twoKeysDown', 'pauseEvent', 'toClipBoard', 'nodeType', 'clearSelection', 'docRdy', 'isInViewport', 'date', 'distArr']
//     }
//     $.cl = function(log) {
//         console.log(log);
//     }
//     $.twoKeysDown = function(arr, log = false) {
//         var map = {};
//         onkeydown = onkeyup = function(e){
//             e = e || event; // IE...
//             map[e.key] = e.type == 'keydown';
//             var mapKeys = Object.keys(map);
//             var onlyOnce = 0;//otherwise fires 3 times the funtion when clicking combo of 2 keys
//             for ( let i = 0; i < mapKeys.length; i++ ) {
//                 if (log) {
//                     console.log(map);
//                 }
//                 if ( onlyOnce !== 0 ) { return; }
//                 for ( let p = 0; p < arr.length; p+=3 ) {
//                     if ( map[ arr[p] ] && map[ arr[p+1] ] ) {
//                         arr[p+2](e);

//                         onlyOnce++;
//                     }
//                 }
//             }
//         }
//     };
//     $.pauseEvent = function(e) {
//         if(e.stopPropagation) e.stopPropagation();
//         if(e.preventDefault) e.preventDefault();
//         e.cancelBubble = true;
//         e.returnValue = false;
//         return false;
//     };
//     $.toClipBoard = function(string, log = false) {
//         var textArea = document.createElement('textarea');
//             textArea.style.width = '100%';
//             textArea.style.height = '100vh';
//             textArea.textContent = string;

//         document.body.appendChild(textArea);
//         textArea.select();
//         document.execCommand('copy');
//         document.body.removeChild(textArea);
//         if ( log ) {
//             console.log('Text copied to clipboard:', string);
//         }
//     };
//     $.nodeType = function(el) {
//         if (!el || el.length === 0) return 'n/a';

//         var arr = [];
//         var nl = 0;

//         if (el.length) {
//             for ( let i = 0; i < el.length; i++ ) {
//                 arr.push(toStr(el[i].nodeType));
//                 nl++;
//             }
//             if (nl === el.length) {
//                 return 'nodeList';
//             } else {
//                 return arr;
//             }
//         } else {
//             return toStr(el.nodeType);
//         }

//         function toStr(nt) {
//             if (nt === 1) return 'node';
//             if (nt === 3) return 'text';
//             if (nt === 8) return 'comment';
//         }
//     };
//     $.clearSelection = function() {
//         if ( document.selection && document.selection.empty ) {
//             document.selection.empty();
//         } else if ( window.getSelection ) {
//             var sel = window.getSelection();
//             sel.removeAllRanges();
//         }
//     };
//     $.docRdy = function(fn) {
//         if (document.readyState === "complete" || document.readyState === "interactive") {
//             setTimeout(fn, 1);
//         } else {
//             document.addEventListener("DOMContentLoaded", fn);
//         }
//     };
//     $.isInViewport = function(el) {
//         var rect = el.getBoundingClientRect();
//         var html = document.documentElement;
//         return (
//             rect.top >= 0 &&
//             rect.left >= 0 &&
//             rect.bottom <= (window.innerHeight || html.clientHeight) &&
//             rect.right <= (window.innerWidth || html.clientWidth)
//         );
//     };

//     $.distArr = function(arr) {
//         var obj = arr.reduce(function (acc, curr) {
//             acc[curr] ? acc[curr]++ : acc[curr] = 1;
//             return acc;
//         }, {});

//         return {arr: Object.keys(obj), info: obj};
//     }
//     $.date = function() {
//         var now = new Date;

//         var day = now.getDate();
//         if ( day < 10 ) { day = "0" + day };

//         var month = now.getMonth() + 1;
//         if ( month < 10 ) { month = "0" + month };

//         var year = now.getFullYear();

//         var seconds = now.getSeconds();
//         if ( seconds < 10 ) { seconds = "0" + seconds };

//         var minutes = now.getMinutes();
//         if ( minutes < 10 ) { minutes = "0" + minutes };

//         var hours = now.getHours();
//         if ( hours < 10 ) { hours = "0" + hours };

//         var time = hours + ":" + minutes + ":" + seconds;
//         var date = day + "/" + month + "/" + year;

//         return {time: time, date: date, year: year, month: month, day: day, hour: hours, minute: minutes, second: seconds};
//     };
// })();
