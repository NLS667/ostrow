import { sliceEvents, createPlugin } from '@fullcalendar/core';

const CustomViewConfig = {

  classNames: [ 'custom-view' ],
  title: 'Harmonogram',
  buttonText: 'Harmonogram',
  type: 'list',
  content: function(props) {
    let segs = sliceEvents(props, true); // allDay=true
    let html =
      '<div class="view-title">' +
        props
      '</div>'

    return { html: html }
  }

}

export default createPlugin({
  views: {
    custom: CustomViewConfig
  }
});