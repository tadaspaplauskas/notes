<script>
import {debounce, assign, find} from "lodash";

export default {
  data() {
    return {
      notes: [],
    }
  },
  mounted() {
    this.loadNotes()

    EventBus.$on('note-updated', debounce((note) => { this.saveNote(note) }, 1000))
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
        content: `
          <p>
          </p>
      `
      })
    },
    saveNote(note) {
      // exists
      if (note.id)
        this.updateNote(note)
      else
        this.createNote(note)
    },
    updateNote(note) {
      axios.put('/notes/' + note.id, note)
        .then(response => {
            note = response.data.data
        })
        .catch(error => {
            console.log(error.response.data)
        })
    },
    createNote(note) {
      axios.post('/notes', note)
        .then(response => {
            assign(note, response.data.data)
        })
        .catch(error => {
            console.log(error.response.data)
        })
    },
    deleteNote(note) {
      axios.delete('/notes/' + note.id)
        .then(response => {

            this.notes = this.notes.filter(obj => {
              return obj.id !== note.id
            })

            // note.editor.destroy()

            console.log(this.notes)
        })
    },
  },

}
</script>
