if (typeof Chart !== "undefined") {
    Chart.pluginService.register({
        beforeDraw: function(chart) {
            if (chart.config.options.elements.title) {
                //Get ctx from string
                var ctx = chart.chart.ctx;

                //Get options from the center object in options
                var titleConfig = chart.config.options.elements.title;
                var fontStyle = titleConfig.fontStyle || "Arial";
                var txt = titleConfig.text;
                var color = titleConfig.color || "#000";
                var sidePadding = titleConfig.sidePadding || 20;
                var sidePaddingCalculated =
                    (sidePadding / 100) * (chart.innerRadius * 2);
                //Start with a base font of 30px
                ctx.font = "16px " + fontStyle;

                //Get the width of the string and also the width of the element minus 10 to give it 5px side padding
                var stringWidth = ctx.measureText(txt).width;
                var elementWidth =
                    chart.innerRadius * 2 - sidePaddingCalculated;

                // Find out how much the font can grow in width.
                var widthRatio = elementWidth / stringWidth;
                var newFontSize = Math.floor(30 * widthRatio);
                var elementHeight = chart.innerRadius * 2;

                // Pick a new font size so it will not be larger than the height of label.
                var fontSizeToUse = Math.min(newFontSize, elementHeight);

                //Set font settings to draw it correctly.
                ctx.textAlign = "start";
                ctx.textBaseline = "Top";
                var centerX = 10;
                    // (chart.chartArea.left + chart.chartArea.right) / 2;
                var centerY = 10;
                    // (chart.chartArea.top + chart.chartArea.bottom) / 2;
                // ctx.font = fontSizeToUse + "px " + fontStyle;
                ctx.fillStyle = color;

                //Draw text in center
                ctx.fillText(txt, centerX, centerY);
            }
        }
    });
} else {
    console.error("Chart plugin not registered!");
}
