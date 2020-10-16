export default {
    computed: {
        roles() {
            return this.$page.auth.user.data.roles
        },
        permissions() {
            return this.$page.auth.user.data.permissions
        }
    },
    methods: {
        can(condition) {
            if (!this.$page.auth.check) {
                return false
            }

            if (this.hasRole('super-admin')) {
                return true
            }

            if (typeof condition === 'object') {
                return this.isOwner(condition)
            }

            const [type, c] = condition.split(':')

            switch (type) {
                case 'permission':
                    return this.hasPermission(c)

                case 'role':
                    return this.hasRole(c)
            }

            return false
        },
        hasRole(role) {
            return this.roles.some(item => item.name === role)
        },
        hasPermission(permission) {
            const p = permission.split('.')

            const permissions = p.map((elem, index, array) => {
                return array.filter((e, i) => i <= index).join('.') + '.*'
            })
            permissions.push(permission)

            return this.permissions.some(item => permissions.includes(item.name))
        },
        isOwner(model) {
            return this.$page.auth.user.data.id === model.user_id
        }
    }
}
