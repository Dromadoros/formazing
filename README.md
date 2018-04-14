**Formazing**

Formazing is a light module that gives you the possibility to add quickly custom forms in your content as field and save all submitted forms.

_Setup_

1. Enable the formazing module
2. Launch the entity update (drush entup -y)
3. Go to /admin/structure/formazing_entity and create your forms
4. Add the formazing field into your content type, paragraph type or whatever you want
5. Create/Edit your content and select your form
6. Enjoy

`If you want to do some more things on submitted forms, you can handle it with a hook_formazing OR hook_formazing_FORM-ID`