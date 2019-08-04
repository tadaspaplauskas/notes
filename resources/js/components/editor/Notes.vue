<script>

export default {
  data() {
    return {
      snippets: [],
    }
  },
    mounted() {

    },
    computed: {
    },
    methods: {
      addSnippet() {
        this.snippets.push({
          'content': `
          <p>
            Hey, try to select some text here. There will popup a menu for selecting some inline styles. <em>Remember:</em> you have full control about content and styling of this menu.
          </p>
        `
        });

      },
    },

}
</script>
