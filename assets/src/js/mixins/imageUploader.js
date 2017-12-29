export default {
    data() {
        return {
            fileFrame: null
        };
    },

    methods: {
        openImageManager(options) {
            const vm = this;
            const images = [];

            if (vm.fileFrame) {
                vm.fileFrame.open();
                return;
            }

            let fileStatesOptions = {
                library: wp.media.query(),
                multiple: false, // set it true for multiple image
                title: __('Add Image'),
                priority: 20,
                filterable: 'uploaded'
            };

            if (!options) {
                options = {};
            }

            fileStatesOptions = $.extend(true, fileStatesOptions, options.fileStatesOptions);

            const fileStates = [
                new wp.media.controller.Library(fileStatesOptions)
            ];

            let mediaOptions = {
                title: __('Add Image'),
                library: {
                    type: ''
                },
                button: {
                    text: __('Add Image')
                },
                multiple: false
            };

            mediaOptions = $.extend(true, mediaOptions, options.mediaOptions);
            mediaOptions.states = fileStates;

            vm.fileFrame = wp.media(mediaOptions);

            vm.fileFrame.on('select', () => {
                const selection = vm.fileFrame.state().get('selection');

                selection.map((attachment) => {
                    return images.push(attachment.toJSON());
                });

                if (typeof vm.onSelectImages === 'function') {
                    vm.onSelectImages(images);
                } else {
                    this.error(__('Component is missing onSelectImages method'));
                }
            });

            vm.fileFrame.on('ready', () => {
                vm.fileFrame.uploader.options.uploader.params = {
                    type: 'wemail-image-uploader'
                };
            });

            vm.fileFrame.open();
        }
    }
};