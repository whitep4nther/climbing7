
var count = 0;

window.PostGalleryEditor = React.createClass({

	getInitialState() {
	    return {
	        images: this.props.images,
	        pending: [] 
	    };
	},
	componentDidMount() {
		this.guid = count++;
	    this.cbName = this.guid+'postGalleryEditor'+this.props.postId+'gallery' 
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

	render: function () {
		var gallery = this.state.images.map(function (image) {
			return <img src={MEDIA_DIR + image.full_path + '?height=100'} height="100" className={this.state.pending.indexOf(image) != -1 ? 'selected' : ''}/>;
		}.bind(this));

		return (
			<div id={'galleryPost'+this.props.postId} className="gallery-editor">
				<div className="images">
					{gallery}
				</div>
				<button onClick={this.openLibrary}>Ajouter des images</button>
			</div>
		);
	}
});