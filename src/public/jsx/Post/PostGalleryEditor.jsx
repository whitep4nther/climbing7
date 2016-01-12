
window.PostGalleryEditor = React.createClass({

	render: function () {
		var gallery = this.props.images.map(function (image) {
			return <img src={MEDIA_DIR + image.full_path + '?height=100'} height="100"/>;
		});

		return (
			<div id={'galleryPost'+this.props.postId}>
				{gallery}
			</div>
		);
	}
});