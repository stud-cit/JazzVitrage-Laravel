<template>
    
    <div>
        <form>
            <div class="mb-5">
                <label>Example textarea</label>
                <textarea class="form-control mb-2" rows="5" readonly>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </textarea>
                <button type="button" @click="edit" class="btn btn-outline-secondary px-5 pull-right">Редагувати</button>
            </div>
            <div class="mb-5">
                <label>Example textarea</label>
                <textarea class="form-control mb-2" rows="5" readonly>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </textarea>
                <button type="button" @click="edit" class="btn btn-outline-secondary px-5 pull-right">Редагувати</button>
            </div>
        </form>
    </div>

</template>

<script>
export default {
    data() {
        return {
            showButton: true
        }
    },
    methods: {
        edit(event) {
            const textarea = event.target.parentElement.querySelector("textarea");
            if(this.showButton) {
                textarea.removeAttribute('readonly');
                textarea.focus();
                event.target.innerHTML = 'Зберегти';
                this.showButton = false
            }
            else {
                textarea.setAttribute('readonly', 'readonly');
                event.target.innerHTML = 'Редагувати';
                this.showButton = true
            }
        }
    }
}
</script>