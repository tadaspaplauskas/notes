<script>
import {debounce} from "lodash";

export default {
  data() {
    return {
      notes: [],
      dirty: [],
    }
  },
  mounted() {
    this.loadNotes()

    EventBus.$on('note-updated', debounce((note) => { this.saveNote(note) }, 3000))

  },
  computed: {
  },
  methods: {
    loadNotes() {
      axios.get('/notes')
        .then(response => {
          this.notes = response.data.data
        })
        .catch(error => {
          console.log(error.response.data)
        })
    },
      addNote() {
        this.notes.push({
          focus: true,
          content: `
            <p>
            </p>
        `
        })
    },
    saveNote(note) {
        axios.put('/notes/' + note.id, note)
        .then(response => {
            note = response.data.data
        })
        .catch(error => {
            console.log(error.response.data)
        })
    },
  },

}
</script>
