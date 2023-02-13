import { sliceEvents, createPlugin } from '@fullcalendar/core';

const CustomViewConfig = {

  classNames: [ 'custom-view' ],
  content: function(props) {
    let html =
      '<div class="view-title">' +
        JSON.stringify(props, null, 2)
      '</div>'

    return { html: html }
  }

}

export default createPlugin({
  views: {
    custom: CustomViewConfig
  }
});