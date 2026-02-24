# TODO: Fix Teachers Page

## 1. Update TeachersController ✅
- Implement index method with pagination, search, and filters.
- Implement create, store, edit, update, destroy methods.
- Implement importcreated, exportTemplate, import methods.

## 2. Create Request Classes ✅
- Create StoreTeacherRequest in app/Http/Requests/Admin/teacher/.
- Create UpdateTeacherRequest in app/Http/Requests/Admin/teacher/.

## 3. Create TeachersImport Class ✅
- Create TeachersImport in app/Imports/ for Excel import.

## 4. Create Views ✅
- Create create.blade.php in resources/views/admin/teachers/. ✅
- Create edit.blade.php in resources/views/admin/teachers/. ✅
- Create import.blade.php in resources/views/admin/teachers/. ✅
- Fix index.blade.php to display teachers data correctly (name, nip, subject). ✅

## 5. Update Routes ✅
- Add import and export routes in routes/admin.php.

## 6. Verify and Test ✅
- Ensure all functionality works like users page.
