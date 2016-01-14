
var count = 0;

var classNames = require('classnames');

window.PostGalleryEditor = React.createClass({

	getInitialState() {
	    return {
	        images: this.props.images,
	        deleting: [],
	        pending: [] 
	    };
	},
	componentDidMount() {
		this.guid = count++;
	    this.cbName = this.guid+'postGalleryEditor'+this.props.postId+'gallery';
	},

	cbName: null,
	openLibrary: function () {
		if (!window[this.cbName])
			window[this.cbName] = this.libraryCallback;

		openLibrary(this.cbName, true);
	},
	libraryCallback: function (files) {
		this.setState({
			images: this.state.images.concat(files),
			pending: files
		});

		API
			.createMediasPostRelationship(this.props.postId, files, 'gallery')
			.then(function () {
				this.setState({pending: []});
			}.bind(this));

		// this.setState({
		// 	image: file,
		// 	editing: true
		// });

		// API
		// .updatePostFields(this.props.postId, fields)
		// .then(function () {
		// 	this.setState({editing: false, message: 'L\'image a bien été changée'})
		// }.bind(this));
	},

	removeImage: function (image) {
		var n = this.state.deleting.slice();
		n.push(image.relationship_id);
		n.filter(function (value, index, self) { return self.indexOf(value) === index; });
		this.setState({deleting: n});

		API
			.detachMediaFromPost(this.props.postId, image.relationship_id)
			.then(function () {
				this.setState({
					images: this.state.images.filter(function (img) { return img.relationship_id != image.relationship_id; }),
					deleting: this.state.deleting.filter(function (id) { return id != image.relationship_id; })
				});
			}.bind(this))
	},

	render: function () {
		var gallery = this.state.images.map(function (image) {
			return <img
						src={MEDIA_DIR + image.full_path + '?height=100'}
						onClick={this.removeImage.bind(this, image)}
						className={
							classNames({
								pending: this.state.pending.indexOf(image) != -1,
								deleting: this.state.deleting.indexOf(image.relationship_id) != -1
							})
						}
					/>;

		}.bind(this));

		return (
			<div id={'galleryPost'+this.props.postId} className="gallery-editor">
				<div className="images">
					{gallery}
				</div>
				<button type="button" onClick={this.openLibrary} disabled={this.state.pending.length > 0}>Ajouter des images</button>
			</div>
		);
	}
});