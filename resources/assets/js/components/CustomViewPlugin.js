import { sliceEvents, createPlugin } from '@fullcalendar/core';

const CustomViewConfig = {

  classNames: [ 'custom-view' ]

}

export default createPlugin({
  views: {
    custom: CustomViewConfig
  }
});