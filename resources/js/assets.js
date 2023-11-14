module.exports = {
  methods: {
      asset(path) {
          var base_path = window._asset || '';
          return base_path + path;
      }
  }
}