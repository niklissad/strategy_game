var BattleManager = (function () {
    var self = this;

    this.connection = null;

    this.units = {
        red: {
            CommandCenter: '/img/red/center.png',
            Fighter: '/img/red/fighter.png',
            Soldier: '/img/red/soldier.png',
            Tank: '/img/red/tank.png'
        },
        blue: {
            CommandCenter: '/img/blue/center.png',
            Fighter: '/img/blue/fighter.png',
            Soldier: '/img/blue/soldier.png',
            Tank: '/img/blue/tank.png'
        }
    };

    this.init = function () {
        self.connection = new WebSocket('ws:' + location.hostname + '/socket');
        self.connection.onopen = function (event) {
            console.log('Connection is opened');
        };
        self.connection.onmessage = function (event) {
            var data = jQuery.parseJSON(event.data);
            console.log(data)

            self.generateBlocks(data.blocks);
            self.message(data)
        };
        self.connection.onclose = function (event) {
            if (event.wasClean) {
                console.log('Connection was closed');
            } else {
                console.log('Connection was interrupted');
            }
        };
        self.connection.onerror = function (error) {
            console.log(error.message);
        };

        $('.unit-block').removeClass('active');

        $('.unit-block').click(function () {
            var actived = $('.unit-block.active');
            $('.unit-block').removeClass('active');

            if (actived.length && actived.data('hasUnit')) {
                self.event(actived, $(this));
            } else {
                $(this).addClass('active');
            }
        });
    };

    this.generateBlocks = function (blocks) {
        $('.earth-block, .fly-block').removeData('hasUnit').removeData('x').removeData('y');

        blocks.forEach(function (block) {
            var id = 'x' + block.x + 'y' + block.y;
            $('#' + id).attr('earth', block.earth);

            var flyBlock = $('#fly-' + id)
                .data('hasUnit', false)
                .data('x', block.x)
                .data('y', block.y)
                .html('');

            if (block.flyUnit) {
                flyBlock
                    .html(self.generateUnitBlock(block.flyUnit))
                    .data('hasUnit', true);
            }

            var earthBlock = $('#earth-' + id)
                .data('hasUnit', false)
                .data('x', block.x)
                .data('y', block.y)
                .html('');

            if (block.earthUnit) {
                earthBlock
                    .html(self.generateUnitBlock(block.earthUnit))
                    .data('hasUnit', true);
            }
        });

        $('.unit-block').removeClass('active');
    };

    this.event = function (from, to) {
        if (from.data('y') == to.data('y') && from.data('x') == to.data('x') && from.data('fly') == to.data('fly')) {
            return;
        }

        var event = {
            action: 'move',
            from: {
                x: from.data('x'),
                y: from.data('y'),
                fly: (from.data('fly') == 1 ? true : false)
            },
            to: {
                x: to.data('x'),
                y: to.data('y'),
                fly: (to.data('fly') == 1 ? true : false)
            }
        };

        if (to.data('hasUnit')) {
            event.action = 'attack';
        }

        console.log(event);
        self.connection.send(JSON.stringify(event));
    };

    this.message = function (data) {
        $('.message').html(data.message);
        $('.message_status').html(data.isStep ? 'Ваший хід' : 'Хід суперника');
    };

    this.generateUnitBlock = function (unit) {
        var img = self.units[unit.command][unit.type];
        img = '<div class="gameBlock"><img src="' + img + '" height="50px" width="50px"></div>';

        var text = '<div class="gameBlock">Life: ' + unit.life + '</div>';

        var html = img + text;

        return html;
    };
});

$(document).ready(function () {
    var manager = new BattleManager();
    manager.init();
});