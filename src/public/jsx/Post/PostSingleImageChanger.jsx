
var count = 0;

window.PostSingleImageChanger = React.createClass({

	getInitialState() {
	    return {
	          image: this.props.image,
	          editing: false,
	          message: false
	    };
	},

	cbName: null,
	componentDidMount: function () {
		this.guid = count++;
		this.cbName = this.guid+'postImageChanger'+this.props.postId+this.props.field
	},

	openLibrary: function () {
		if (!window[this.cbName])
			window[this.cbName] = this.libraryCallback;

		openLibrary(this.cbName);
	},
	libraryCallback: function (file) {
		var fields = {};
		fields[this.props.field] = file.id;

		this.setState({
			image: file,
			editing: true
		});

		API
		.updatePostFields(this.props.postId, fields)
		.then(function () {
			this.setState({editing: false, message: 'L\'image a bien été changée'})
		}.bind(this));
	},

	render: function () {
		var image;

		 if (this.state.image) {
		 	var style = {};

		 	if (this.state.editing)
		 		style.opacity = 0.6;

		 	image = <img src={LIBRARY_DIR + this.state.image.full_path} style={style}/>;

		 } else
		 	image = 'Pas d\'image';

		var message = this.state.message && !this.state.editing ? <p className="success-message">{this.state.message}</p> : false;

		return (
			<div id={'post-'+this.props.field+'-imageChanger'}>
				{image}
				{message}
				<button onClick={this.openLibrary}>Changer</button>
			</div>
		);
	}
});